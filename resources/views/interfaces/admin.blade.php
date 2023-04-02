@php $admin = true; @endphp
@extends('common.layout')

@section('title', 'Welcome')


@section('content')
<style>
  .custom_container {
      min-height: 70vh;
  }
    .cthead-dark {
        background: #282525dd;
        color: #fff;
    }
.c-table {
    width: 100%;
    display: inline-table;
    border-bottom: 1px solid #ccc;
}
.odd {
  background: rgba(0,0,0,0.05);
}
td {
    padding: 15px !important;
}
.fa-ban {
  font-size: 20px;
  cursor:pointer;
}
.unban, .ban:hover {
  color: #ff0000;
}
</style>

<div class="container_styled_1">
  <div class="container margin_60_35">
      <div class="custom_container bg-white">
   <div class="container">
       <div class="row pt-5 mb-4">
           <div class="col-sm-7 col-md-10 col-lg-7  justify-content-center align-self-center">
        <h2 class="section-title my-2">User Management</h2>
      </div>
    </div>


    <table class="table table-bordered align-content-center c-table"
      id="admin_table" style="width:100%">
      <thead class="cthead-dark">
      <tr>
        <th style="width:30px;">No</th>
        <th style="">Name</th>
        <th style="width:200px;">Email</th>
        <th style="width:200px;">Is verified</th>
        <th style="width:100px;">Status</th>
        <th style="width:100px;">Ban</th>
      </tr>
      </thead>
      <tbody class="tablebody">
      </tbody>
</table>
<!---- ---->
  </div>
</div>

  </div>
</div>
@endsection

@section('js')
<script>
  var user_table = $('#admin_table').DataTable({
      "destroy": true,
      "processing": false,
      "serverSide": true,
      "autoWidth": false,
      "ajax": {
        url:"{{route('usermanagement.datatable_main')}}",
        type: "POST",
        "data": {
        }
      },
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'is_verified', name: 'is_verified'},
        {data: 'status', name: 'status'},
        {data: 'ban', name: 'ban'},
      ],
      "order": [],
      "columnDefs": [
        {"className": "text-center", "targets": [0,3,4,5]},
        {"className": "text-right", "targets": []}
      ]

  });

  function ban(id) {
      $.post("{{route('usermanagement.user.ban')}}", {
        user_id: id
      }).done( (res) => {
        user_table.ajax.reload();
      }).fail( (data) => {
        alert("Some error occcured");
      });;
  }
</script>
@endsection
