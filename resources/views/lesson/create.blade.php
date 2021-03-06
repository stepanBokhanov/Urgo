@extends('layouts.master')

@section('title') Add Lesson @endsection

@section('css')
<!-- Summernote css -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/summernote/summernote.min.css') }}">
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('title') Add Lesson @endslot
@slot('li_1') Lesson @endslot
@slot('li_2') Add Lesson @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('lesson_store')}}" method="post" enctype="multipart/form-data"
                    onsubmit="beforeSubmit()">
                    @csrf
                    <h4 class="card-title">Input Data for Lesson</h4>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Category</label>
                        <div class="col-md-10">
                            <select name="category" id="" class="form-control">
                                @foreach ($categories as $obj)
                                <option value="{{$obj->id}}">Phase {{$obj->phase}}: {{$obj->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Order</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="order" value="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Title</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Description</label>
                        <div class="col-md-10">
                            <textarea id="textarea_description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Key Takeaway</label>
                        <div class="col-md-10">
                            <textarea id="textarea_keytakeaway" name="keytakeaway"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Action Steps</label>
                        <div class="col-md-10">
                            <textarea id="textarea_action" name="action"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Resources</label>
                        <div class="col-md-10">
                            <div class="repeater">
                                <div data-repeater-list="group-a">
                                    <div data-repeater-item class="mb-3 row">
                                        <div class="col-md-4">
                                            <input class="form-control resourcetitleinput" type="text" name="resources"
                                                placeholder="Enter title">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control resourcelinkinput" type="text" name="resources"
                                                placeholder="Ex: http://test.com/test">
                                        </div>
                                        <div class="col-md-2">
                                            <input data-repeater-delete type="button"
                                                class="btn btn-danger btn-block inner waves-effect waves-light"
                                                value="Delete" />
                                        </div>
                                    </div>
                                </div>
                                <input data-repeater-create type="button" class="btn btn-success inner"
                                    value="Add Resource" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Download Files</label>
                        <div class="col-md-10">
                            <div class="repeater">
                                <div data-repeater-list="group-a">
                                    <div data-repeater-item class="inner mb-3 row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control downloaddescriptioninput"
                                                placeholder="Enter description">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="file" class="form-control donwloadfileinput" />
                                        </div>
                                        <div class="col-md-2">
                                            <input data-repeater-delete type="button"
                                                class="btn btn-danger btn-block inner waves-effect waves-light"
                                                value="Delete" />
                                        </div>
                                    </div>
                                </div>
                                <input data-repeater-create type="button" class="btn btn-success inner"
                                    value="Add Download" />
                            </div>
                        </div>
                    </div>
                    {{--   <div class="form-group row">
                            <label class="col-md-2 col-form-label">Video</label>
                            <div class="col-md-10">
                                <input class="form-control" type="file"   name="video">
                            </div>
                        </div> --}}
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Duration</label>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="duration_hour" min=0 value="0">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="option-startDate">Hour</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="duration_minute" min=0 value="0">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="option-startDate">Minute</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="duration_second" min=0 value="0">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="option-startDate">Second</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Timestamps</label>
                        <div class="col-md-10">
                            <div class="repeater">
                                <div data-repeater-list="group-a">
                                    <div data-repeater-item class="inner mb-3 row">
                                        <div class="col-md-2">
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control stampmininput" min=0 value="0"
                                                    aria-describedby="option-startDate">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="option-startDate">Minute</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control stampsecinput" min=0 value="0"
                                                    aria-describedby="option-startDate">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="option-startDate">Second</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="inner form-control stampdescriptioninput"
                                                placeholder="Enter Description" />
                                        </div>
                                        <div class="col-md-2">
                                            <input data-repeater-delete type="button"
                                                class="btn btn-danger btn-block inner waves-effect waves-light"
                                                value="Delete" />
                                        </div>
                                    </div>
                                </div>
                                <input data-repeater-create type="button" class="btn btn-success inner"
                                    value="Add Timestamp" />
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4 class="card-title">Input Data for Lesson Tile</h4>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Tile Title</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="tile_title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Tile Desciption</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="tile_description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Tile Image</label>
                        <div class="col-md-10">
                            <input class="form-control" type="file" name="tile_image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Short Video for Hover</label>
                        <div class="col-md-10">
                            <input class="form-control" type="file" name="tile_video">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Lesson</button>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->

@endsection
@section('script')

<!-- form mask -->
<script src="{{ URL::asset('assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

<!--tinymce js-->
<script src="{{ URL::asset('assets/libs/tinymce/tinymce.min.js') }}"></script>

<!-- Summernote js -->
<script src="{{ URL::asset('assets/libs/summernote/summernote.min.js') }}"></script>

<script>
    $(document).ready(function () {
            0 < $("#textarea_description").length && tinymce.init({
                selector: "textarea#textarea_description",
                height: 300,
                plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "save table contextmenu directionality emoticons template paste textcolor"],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            })
            0 < $("#textarea_keytakeaway").length && tinymce.init({
                selector: "textarea#textarea_keytakeaway",
                height: 300,
                plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "save table contextmenu directionality emoticons template paste textcolor"],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            })
            0 < $("#textarea_action").length && tinymce.init({
                selector: "textarea#textarea_action",
                height: 300,
                plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "save table contextmenu directionality emoticons template paste textcolor"],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            })

            //Repeater
            $(".repeater").repeater({
                defaultValues: {
                "textarea-input": "foo",
                "number-input": "0",
                "select-input": "B",
                "checkbox-input": ["A", "B"],
                "radio-input": "B"
                },
                show: function show() {
                $(this).slideDown();
                },
                hide: function hide(e) {
                confirm("Are you sure you want to delete this element?") && $(this).slideUp(e);
                },
                ready: function ready(e) {}
            })
        });
        
        function beforeSubmit(){
            //Timestamp
            $("input.stampmininput").attr('name','stampminute[]');
            $("input.stampsecinput").attr('name','stampsecond[]');            
            $("input.stampdescriptioninput").attr('name','stampdescription[]');
            //Resource
            $("input.resourcetitleinput").attr('name','resourcetitle[]');
            $("input.resourcelinkinput").attr('name','resourcelink[]');  
            //Download
            $("input.downloaddescriptioninput").attr('name','downloaddesciption[]');  
            $("input.donwloadfileinput").attr('name','downloadfile[]');  
        }
        
</script>

@endsection