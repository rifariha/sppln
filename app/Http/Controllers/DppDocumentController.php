<?php

namespace App\Http\Controllers;

use App\DataTables\DppDocumentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDppDocumentRequest;
use App\Http\Requests\UpdateDppDocumentRequest;
use App\Repositories\DppDocumentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

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

        $dppDocument = $this->dppDocumentRepository->create($input);

        Flash::success('Dpp Document saved successfully.');

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
            Flash::error('Dpp Document not found');

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
            Flash::error('Dpp Document not found');

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

        if (empty($dppDocument)) {
            Flash::error('Dpp Document not found');

            return redirect(route('dppDocuments.index'));
        }

        $dppDocument = $this->dppDocumentRepository->update($request->all(), $id);

        Flash::success('Dpp Document updated successfully.');

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
            Flash::error('Dpp Document not found');

            return redirect(route('dppDocuments.index'));
        }

        $this->dppDocumentRepository->delete($id);

        Flash::success('Dpp Document deleted successfully.');

        return redirect(route('dppDocuments.index'));
    }
}
