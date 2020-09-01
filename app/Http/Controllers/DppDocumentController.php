<?php

namespace App\Http\Controllers;

use App\DataTables\DppDocumentDataTable;
use App\DataTables\DppDocumentUiksbuDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDppDocumentRequest;
use App\Http\Requests\UpdateDppDocumentRequest;
use App\Repositories\DppDocumentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DppDocumentController extends AppBaseController
{
    /** @var  DppDocumentRepository */
    private $dppDocumentRepository;

    public function __construct(DppDocumentRepository $dppDocumentRepo)
    {
        $this->dppDocumentRepository = $dppDocumentRepo;
    }

    /**
     * Display a listing of the DppDocument.
     *
     * @param DppDocumentDataTable $dppDocumentDataTable
     * @return Response
     */
    public function index(DppDocumentDataTable $dppDocumentDataTable)
    {
        return $dppDocumentDataTable->render('dpp_documents.index');
    }

    public function uiksbu(DppDocumentUiksbuDataTable $dppDocumentUiksbuDataTable)
    {
        return $dppDocumentUiksbuDataTable->render('dpp_documents.index');
    }

    /**
     * Show the form for creating a new DppDocument.
     *
     * @return Response
     */
    public function create()
    {
        return view('dpp_documents.create');
    }

    /**
     * Store a newly created DppDocument in storage.
     *
     * @param CreateDppDocumentRequest $request
     *
     * @return Response
     */
    public function store(CreateDppDocumentRequest $request)
    {
        $input = $request->all();
        
        if ($request->hasFile('file')) 
        {
            $file = $request->file;
            $ext = $file->getClientOriginalExtension();
            $path = $request->file('file')->storeAs('file', Str::slug($request->name) . '.' . $ext);
            $input['file'] = $path;
        }
        
        $input['inputted_by'] = Auth::user()->name;
        $dppDocument = $this->dppDocumentRepository->create($input);

        Flash::success('Dokumen berhasil disimpan.');
        return redirect(route('dppDocuments.index'));
    }

    /**
     * Display the specified DppDocument.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dppDocument = $this->dppDocumentRepository->find($id);

        if (empty($dppDocument)) {
            Flash::error('Dokumen tidak ditemukan');
            return redirect(route('dppDocuments.index'));
        }

        return view('dpp_documents.show')->with('dppDocument', $dppDocument);
    }

    /**
     * Show the form for editing the specified DppDocument.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $dppDocument = $this->dppDocumentRepository->find($id);

        if (empty($dppDocument)) {
            Flash::error('Dokumen tidak ditemukan');

            return redirect(route('dppDocuments.index'));
        }

        return view('dpp_documents.edit')->with('dppDocument', $dppDocument);
    }

    /**
     * Update the specified DppDocument in storage.
     *
     * @param  int              $id
     * @param UpdateDppDocumentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDppDocumentRequest $request)
    {
        $dppDocument = $this->dppDocumentRepository->find($id);

        $input = $request->all();

        if (empty($dppDocument)) {
            Flash::error('Dokumen tidak ditemukan');
            return redirect(route('dppDocuments.index'));
        }

        if ($request->hasFile('file'))
        {
            $file = $request->file;
            $ext = $file->getClientOriginalExtension();
            $path = $request->file('file')->storeAs('file', Str::slug($request->name) . '.' . $ext);
            $input['file'] = $path;
        }
        
        $input['inputted_by'] = Auth::user()->name;
        // dd($input);
        $dppDocument = $this->dppDocumentRepository->update($input, $id);

        Flash::success('Dokumen berhasil diupdate');

        return redirect(route('dppDocuments.index'));
    }

    /**
     * Remove the specified DppDocument from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dppDocument = $this->dppDocumentRepository->find($id);

        if (empty($dppDocument)) {
            Flash::error('Dokumen tidak ditemukan');

            return redirect(route('dppDocuments.index'));
        }

        $this->dppDocumentRepository->delete($id);

        Flash::success('Dokumen berhasil dihapus.');

        return redirect(route('dppDocuments.index'));
    }
}
