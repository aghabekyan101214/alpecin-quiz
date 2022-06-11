@extends('layouts.admin')

@section('content')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <br>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head" style="align-items: center;">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Quizzes Questions</h3>
                    </div>
                    <a href="{{ route('admin.quizzes_questions.create') }}" class="btn btn-outline-primary">
                        <i class="la la-plus"></i>
                        Add Question
                    </a>
                    <a href="javascript:void(0)" class="btn btn-outline-primary sort-btn">
                        <i class="la la-sort"></i>
                        Sort
                    </a>
                </div>
                <div class="kt-portlet__body">
                    @if(session('create-message'))
                        <div class="alert alert-success fade show" role="alert">
                            <div class="alert-text">{{session('create-message')}}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @elseif(session('update-message'))
                        <div class="alert alert-brand fade show" role="alert">
                            <div class="alert-text">{{session('update-message')}}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @elseif(session('delete-message'))
                        <div class="alert alert-danger fade show" role="alert">
                            <div class="alert-text">{{session('delete-message')}}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @endif
                <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                        <tr>
                            <th>Question</th>
                            <th>Order Number</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="sortlist">
                            @foreach($data as $d)
                                <tr class="ui-state-default sorting-tr" data-question-id="{{ $d->id }}">
                                    <td>
                                        <ul>
                                        @foreach($d->translations as $t)
                                            <li>({{ $t->language->language_code }}) {{ $t->question }}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $d->order }}</td>
                                    <td nowrap>
                                        <span class="dropdown">
                                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md btn-req-change" data-toggle="dropdown" aria-expanded="true">
                                              <i class="la la-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('admin.quizzes_questions.edit', $d->id) }}">Edit</a>
                                                <form method="post" action="{{ route('admin.quizzes_questions.destroy', $d->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" style="padding: 0.7rem 1.2rem;">Delete</button>
                                                </form>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!--end: Datatable -->

                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        function slist (target) {
            // (A) SET CSS + GET ALL LIST ITEMS
            target.classList.add("slist");
            let items = target.getElementsByTagName("tr"), current = null;

            // (B) MAKE ITEMS DRAGGABLE + SORTABLE
            for (let i of items) {
                // (B1) ATTACH DRAGGABLE
                i.draggable = true;

                // (B2) DRAG START - YELLOW HIGHLIGHT DROPZONES
                i.ondragstart = (ev) => {
                    current = i;
                    for (let it of items) {
                        if (it != current) { it.classList.add("hint"); }
                    }
                };

                // (B3) DRAG ENTER - RED HIGHLIGHT DROPZONE
                i.ondragenter = (ev) => {
                    if (i != current) { i.classList.add("active"); }
                };

                // (B4) DRAG LEAVE - REMOVE RED HIGHLIGHT
                i.ondragleave = () => {
                    i.classList.remove("active");
                };

                // (B5) DRAG END - REMOVE ALL HIGHLIGHTS
                i.ondragend = () => { for (let it of items) {
                    it.classList.remove("hint");
                    it.classList.remove("active");
                }};

                // (B6) DRAG OVER - PREVENT THE DEFAULT "DROP", SO WE CAN DO OUR OWN
                i.ondragover = (evt) => { evt.preventDefault(); };

                // (B7) ON DROP - DO SOMETHING
                i.ondrop = (evt) => {
                    evt.preventDefault();
                    if (i != current) {
                        let currentpos = 0, droppedpos = 0;
                        for (let it=0; it<items.length; it++) {
                            if (current == items[it]) { currentpos = it; }
                            if (i == items[it]) { droppedpos = it; }
                        }
                        if (currentpos < droppedpos) {
                            i.parentNode.insertBefore(current, i.nextSibling);
                        } else {
                            i.parentNode.insertBefore(current, i);
                        }
                    }
                };
            }
        }


        window.addEventListener("DOMContentLoaded", () => {
            slist(document.getElementById("sortlist"));
        });

        $(".sort-btn").click(function () {
            let data = [];

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".sorting-tr").each(function (i, el) {
                data.push({id: $(this).attr("data-question-id"), order: i + 1});
            });

            let url = "{{ route('admin.quizzes_questions_sor') }}";

            $.post(url, {data}, function( res ) {
                location.reload();
            });
        });

    </script>
@endsection

