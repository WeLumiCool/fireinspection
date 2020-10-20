@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="col-10">
                <div class="accordion md-accordion accordion-blocks border-0" id="accordionStages" role="tablist" aria-multiselectable="true">
                    <div class="card border-bottom py-4">
                        <div class="card-header d-flex justify-content-between border-0" style="background: white" role="tab" id="Stage-3">
                            <a class="text-left collapsed" data-toggle="collapse" data-parent="#accordionStages" href="#build-1Stage-3" aria-expanded="false" aria-controls="build-1Stage-3">
                                <h6 class="mt-1 mb-0">
                                    <span>Этап: <span>всмит</span></span>
                                    <i class="fas fa-angle-down rotate-icon" style="margin-top: 2px;"></i>
                                </h6>
                            </a>
                        </div>

                        <div id="build-1Stage-3" class="collapse" role="tabpanel" aria-labelledby="Stage-3" data-parent="#accordionStages" style="">
                            <div class="card-body p-0">
                                <div class="table-ui  mb-3  mb-4">
                                    <div class="row col-lg-12 col-12 pt-0 justify-content-lg-end text-lg-right text-center">
                                        <p class="font-weight-bold font-small ">21.10.2020</p>
                                    </div>
                                    <div class="row border mx-2">
                                        <div class="col-lg-3 col-12 text-lg-left py-2 text-center border-right">
                                            <p class="h6 font-weight-bold ">Этап:</p>
                                            <p class="text-muted">всмит</p>
                                        </div>
                                        <div class="col-lg-6 col-12 text-lg-left py-2 text-center border-right">
                                            <p class="h6 font-weight-bold ">Описание:</p>
                                            <p class="text-muted">qeqweqweqw</p>
                                        </div>
                                        <div class="col-lg-3 col-12 text-lg-left py-2 text-center border-right">
                                            <p class="h6 font-weight-bold">Документы: Докии</p>
                                            <a href="http://inspection/storage/files/stage/document_5f8d7a6bda642.txt" class="mx-auto" download="">
                                                <i class="fas pt-3 fa-file-pdf fa-4x" style="color: red;"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row border border-top-0 mx-2">
                                        <div class="col-lg-6 border-right pt-3 col-12 text-lg-left text-center">
                                            <p class="h6 font-weight-bold ">Фото объекта:</p>
                                            <div class="row">
                                                <div class="col-3 position-relative">
                                                    <a href="http://inspection/storage/files/stage/image_5f8d7a6bd8c0e.docx" data-fancybox="media1" class="img-fluid">
                                                        <img src="http://inspection/storage/files/stage/image_5f8d7a6bd8c0e.docx" class="mediafile img-fluid m-2" alt=""></a>
                                                    <a href="http://inspection/storage/files/stage/image_5f8d7a6bd8c0e.docx" download="">
                                                        <i class="fas fa-arrow-alt-circle-down stage position-absolute"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 pt-3 text-lg-left text-center">
                                            <p class="h6 font-weight-bold ">Примечание:</p>
                                            <p class=" text-muted">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
