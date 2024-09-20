@extends('layouts.master')

@section('content')
@include('Modals.add-case')
@include('Modals.view-case')
<div class="container">
  <div class="row justify-content-center">
    <div class="col">


      <div class="card" style="position: relative; overflow: auto; background-color: #fff;">
        <div class="card-header d-flex justify-content-between" style="min-width: 666px">
          <h5 class="card-title">ADMINSTRATIVE CASE</h5>
          <div class="card-header-right d-flex" style="gap: 10px">
            <button type="button" id="company_form_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCase">Add New</button>
          </div>
        </div>
        <div class="card-body"> @if (session('status')) <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div> @endif <div class="col-md">
            <div class="card">
              <div class="card-header">Data Table</div>
              <div class="card-body">
                <table class="table table-hover"  id="caseTable" style="width:100%">
                  <thead>
                    <tr>
                      <th>Company Name</th>
                      <th>Company Address</th>
                      <th>Case Number</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    @push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#caseTable').DataTable({
            processing: true,
            ajax: '/cases',
            "order": [[ 0, "desc" ]],
            columns: [
                { data: 'company_name'},
                { data: 'company_address'},
                { data: 'case_number'},
                { data: 'status'},
                { data: 'action'}
            ],scrollCollapse: true,
            scrollY: '45vh',
            scrollX: true
        });
        $("#update").click(function(e){
            e.preventDefault();
            let form = $('#update-form')[0];
            let data = new FormData(form);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('case.update')}}",
                        type: "POST",
                        data : data,
                        dataType:"JSON",
                        processData : false,
                        contentType:false,
                        success: function(response) {
                            if (response.errors) {
                                var errorMsg = '';
                                $.each(response.errors, function(field, errors) {
                                    $.each(errors, function(index, error) {
                                        errorMsg += error + '<br>';
                                    });
                                });
                                iziToast.error({
                                    message: errorMsg,
                                    position: 'topRight'
                                });
                            } else {
                                console.log(response);
                                Swal.fire({
                                    title: "Updated!",
                                    text: "Your file has been updated.",
                                    icon: "success"
                                });
                                $('#viewCase').modal('hide');
                                $('#caseTable').DataTable().ajax.reload();
                                $('#update-form').trigger('reset');
                            }
                        },
                        error: function(xhr, status, error) {
                            iziToast.error({
                                message: 'An error occurred: ' + error,
                                position: 'topRight'
                            });
                        }
                    });
                }
            });
        })
        $("#save_case").click(function(e){
            e.preventDefault();
            let form = $('#addcase-form')[0];
            let data = new FormData(form);

        $.ajax({
            url: "{{route('case.store')}}",
            type: "POST",
            data : data,
            dataType:"JSON",
            processData : false,
            contentType:false,
            success: function(response) {

                if (response.errors) {
                    var errorMsg = '';
                    $.each(response.errors, function(field, errors) {
                        $.each(errors, function(index, error) {
                            errorMsg += error + '<br>';
                        });
                    });

                    iziToast.error({
                        message: "Kindly complete all required fields!",
                        position: 'topRight'
                    });
                    // toastr.error('Kindly complete all required fields!');

                } else {
                    iziToast.success({
                        message: response.success,
                        position: 'topRight'
                    });
                    // toastr.success('Legal has been added!');

                    $('#addCase').modal('hide');
                    $('#caseTable').DataTable().ajax.reload();
                    $('#addcase-form').trigger('reset');
                }

            },
            error: function(xhr, status, error) {
                iziToast.error({
                    message: 'An error occurred: ' + error,
                    position: 'topRight'
                });
            }
      });
    })
    function viewCase(id){
        var caseid = $(this).data(id);
       $.get('/editcase/' + id, function (casedata) {
        //    $('#electionModal').html("Modal");
        //    $('#electionId').val(election.id);
        //    $('#ajax-election-modal').modal('show');
            $("#vid").val(casedata.id);
            $('#ename').val(casedata.company_name);
            $('#eaddress').val(casedata.company_address);
            $('#ecaseNmber').val(casedata.case_number);
            $('#estatus').val(casedata.status);
            $("#linkCase").attr('href', '/pdf/'+casedata.id);
            $("#viewCase").modal('show');
            console.log(casedata);
       })
        // $.ajax({
        //     url: "editcase/"+id,
        //     type: "POST",
        //     data : id,
        //     dataType:"JSON",
        //     processData : false,
        //     contentType:false,
        //     success: function(response) {

        //         if (response.errors) {
        //             var errorMsg = '';
        //             $.each(response.errors, function(field, errors) {
        //                 $.each(errors, function(index, error) {
        //                     errorMsg += error + '<br>';
        //                 });
        //             });

        //             iziToast.error({
        //                 message: "Kindly complete all required fields!",
        //                 position: 'topRight'
        //             });
        //             // toastr.error('Kindly complete all required fields!');

        //         } else {
        //             // iziToast.success({
        //             //     message: response.success,
        //             //     position: 'topRight'
        //             // });
        //             // toastr.success('Legal has been added!');

        //             // $('#addCase').modal('hide');
        //             // $('#caseTable').DataTable().ajax.reload();
        //             // $('#addcase-form').trigger('reset');
        //             $("#viewCase").modal('show');
        //             console.log(response);
        //         }

        //     },
        //     error: function(xhr, status, error) {
        //         iziToast.error({
        //             message: 'An error occurred: ' + error,
        //             position: 'topRight'
        //         });
        //     }
        // });
    }
    function deleteCase(id){
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax(
                {
                    url: "/deletecase/"+id,
                    type: 'DELETE',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                    },
                    success: function ()
                    {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your legal case has been deleted.",
                            icon: "success"
                        });
                        $('#caseTable').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: "Error!",
                            text: "An error occurred while deleting the file.",
                            icon: "error"
                        });
                    }
                });
            }
        });

    }
    </script>
    @endpush
@endsection
