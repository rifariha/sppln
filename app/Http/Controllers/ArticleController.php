<?php

namespace App\Http\Controllers;

use App\DataTables\ArticleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repositories\ArticleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Article;
use App\Models\ArticleCategory;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepository = $articleRepo;
    }

    /**
     * Display a listing of the Article.
     *
     * @param ArticleDataTable $articleDataTable
     * @return Response
     */
    public function index(ArticleDataTable $articleDataTable)
    {
        return $articleDataTable->render('articles.index');
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */
    public function create()
    {
        $category = ArticleCategory::pluck('category_name','id');
        return view('articles.create')->with('category', $category);;
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateArticleRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->image;
            $ext = $file->getClientOriginalExtension();
            
            $path = $request->file('image')->storeAs('artikel', Str::slug($request->title) . '.' . $ext);
            
            //make thumbnail
            $thumbnailName = Str::slug($request->title) . '.' . $ext;
            $thumbnailPath = public_path('/thumbnail/' . $thumbnailName);
            $this->resize_crop_image(500, 500, $request->file('image'), $thumbnailPath);

            $input['thumbnail'] = $thumbnailName;
            $input['image'] = $path;
        }
        
        $input['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        $input['created_by'] = Auth::user()->name;
        $article = $this->articleRepository->create($input);

        Flash::success('Artikel berhasil ditambah.');

        return redirect(route('articles.index'));
    }

    /**
     * Display the specified Article.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        return view('articles.show')->with('article', $article);
    }

    /**
     * Show the form for editing the specified Article.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }
        $category = ArticleCategory::pluck('category_name','id');
        return view('articles.edit',compact(['article', 'category']));
    }

    /**
     * Update the specified Article in storage.
     *
     * @param  int              $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticleRequest $request)
    {
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            Flash::error('Artikel tidak ditemukan');

            return redirect(route('articles.index'));
        }

        $input = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->image;
            $ext = $file->getClientOriginalExtension();
            
            $path = $request->file('image')->storeAs('artikel', Str::slug($request->title) . '.' . $ext);
            
            //make thumbnail
            $thumbnailName = Str::slug($request->title) . '.' . $ext;
            $thumbnailPath = public_path('/thumbnail/' . $thumbnailName);
            $this->resize_crop_image(500, 500, $request->file('image'), $thumbnailPath);

            $input['thumbnail'] = $thumbnailName;
            $input['image'] = $path;
        }
        
        if(empty($request->image))
        {
            $input['image'] = $article->image;
        }

        $input['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        $input['created_by'] = Auth::user()->name;
                
        $article = $this->articleRepository->update($input, $id);

        Flash::success('Artikel berhasil diupdate.');

        return redirect(route('articles.index'));
    }

    /**
     * Remove the specified Article from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            Flash::error('Artikel tidak ditemukan');

            return redirect(route('articles.index'));
        }

        $this->articleRepository->delete($id);

        Flash::success('Artikel berhasil dihapus.');

        return redirect(route('articles.index'));
    }

    public function publish($id)
    {
        $article = $this->articleRepository->find($id);
        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        $change = $article->status == true ? false : true;
        
        Article::where('id',$id)->update(['status' => $change]);
        
        $change != false ? Flash::success('Article berhasil diunpublish') : Flash::success('Article berhasil dipublish'); 
        
        return redirect(route('articles.index'));
    }

    function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80)
    {
        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];

        switch($mime){
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        }else{
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if($dst_img)imagedestroy($dst_img);
        if($src_img)imagedestroy($src_img);
    }
}
