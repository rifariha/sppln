<?php

namespace App\Http\Controllers;

use App\DataTables\ArticleCategoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateArticleCategoryRequest;
use App\Http\Requests\UpdateArticleCategoryRequest;
use App\Repositories\ArticleCategoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Str;

class ArticleCategoryController extends AppBaseController
{
    /** @var  ArticleCategoryRepository */
    private $articleCategoryRepository;

    public function __construct(ArticleCategoryRepository $articleCategoryRepo)
    {
        $this->articleCategoryRepository = $articleCategoryRepo;
    }

    /**
     * Display a listing of the ArticleCategory.
     *
     * @param ArticleCategoryDataTable $articleCategoryDataTable
     * @return Response
     */
    public function index(ArticleCategoryDataTable $articleCategoryDataTable)
    {
        return $articleCategoryDataTable->render('article_categories.index');
    }

    /**
     * Show the form for creating a new ArticleCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('article_categories.create');
    }

    /**
     * Store a newly created ArticleCategory in storage.
     *
     * @param CreateArticleCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateArticleCategoryRequest $request)
    {
        $input = $request->all();
        $input['slug'] = str::slug($request->category_name,'-');
        
        $articleCategory = $this->articleCategoryRepository->create($input);

        Flash::success('Kategori artikel berhasil ditambah');

        return redirect(route('articleCategories.index'));
    }

    /**
     * Display the specified ArticleCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $articleCategory = $this->articleCategoryRepository->find($id);

        if (empty($articleCategory)) {
            Flash::error('Article Category not found');

            return redirect(route('articleCategories.index'));
        }

        return view('article_categories.show')->with('articleCategory', $articleCategory);
    }

    /**
     * Show the form for editing the specified ArticleCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $articleCategory = $this->articleCategoryRepository->find($id);
        
        if (empty($articleCategory)) {
            Flash::error('Article Category not found');

            return redirect(route('articleCategories.index'));
        }

        return view('article_categories.edit')->with('articleCategory', $articleCategory);
    }

    /**
     * Update the specified ArticleCategory in storage.
     *
     * @param  int              $id
     * @param UpdateArticleCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticleCategoryRequest $request)
    {
        $articleCategory = $this->articleCategoryRepository->find($id);

        if (empty($articleCategory)) {
            Flash::error('Kategori tidak ditemukan');

            return redirect(route('articleCategories.index'));
        }

        $input = $request->all();
        $input['slug'] = str::slug($request->category_name,'-');
        $articleCategory = $this->articleCategoryRepository->update($input, $id);

        Flash::success('Kategori berhasil diubah.');

        return redirect(route('articleCategories.index'));
    }

    /**
     * Remove the specified ArticleCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $articleCategory = $this->articleCategoryRepository->find($id);

        if (empty($articleCategory)) {
            Flash::error('Article Category not found');

            return redirect(route('articleCategories.index'));
        }

        $this->articleCategoryRepository->delete($id);

        Flash::success('Article Category deleted successfully.');

        return redirect(route('articleCategories.index'));
    }
}
