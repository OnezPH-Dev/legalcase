<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('asset/National_Telecommunications_Commission.svg') }}" type="image/x-icon">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.dataTables.css" />

</head>
<body>
<table class="table table-hover row-border"  id="caseTable" style="width:100%">
                  <thead>
                    <tr>
                      <th>Company Name</th>
                      <th>Company Address</th>
                      <th>Case Number</th>
                      <th>Status</th>
                      <th>Date Filed</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
                <script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <script>
        $('#caseTable').DataTable({
            processing: true,
            ajax: '/cases',
            "order": [[ 0, "desc" ]],
            columns: [
                { data: 'company_name'},
                { data: 'company_address'},
                { data: 'case_number'},
                { data: 'status'},
                { data: 'created_at'},
                { data: ''}
            ],
            columnDefs: [
                {
                    data: null,
                    defaultContent: `<div class="d-flex" style="gap: 10px;">
                    <form method="POST" action="/case/{{ $case->id }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="button" class="btn btn-primary">View</button ><button type="button" class="btn btn-danger">Delete</button>
                    </div>`,
                    targets: -1
                }
            ],scrollCollapse: true,
            scrollY: '50vh',
            scrollX: true
        });
    </script>
</body>
</html>
