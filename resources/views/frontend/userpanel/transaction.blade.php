@extends('layouts/frontend')

@section('title', 'Transaction')

@section('styles')
  <link rel="stylesheet" type="text/css" href="https//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
  <style type="text/css">
    .dataTables_filter {
       width: 50%;
       float: right;
       text-align: right;
       padding: 0 1rem;
    }

    .dataTables_filter input[type=search] {
      border: 1px solid #4c4d4d;
      margin: 1rem;
      border-radius: 50px;
      padding: .5rem;
    }

    .dt-buttons {
      padding: 0 1rem;
    }
    .dt-buttons .dt-button, .dt-buttons .dt-button:hover {
      padding: .5rem 3rem;
      color: #fff;
      background: #2c3e50 !important;
      border: none !important;
      font-size: 20px;
      border-radius: 50px;
    }
  </style>
@stop
  
@section('content')
  
  <div class="container py-4">
    <div class="row">
      @include('layouts/userpanel_sidebar')

      <div class="col-lg-9">
        
        <div class="bg-light shadow-sm rounded p-4 mb-4">
          <div class="row profile-completeness">
            
            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
              <div class="border rounded p-3 text-center">
                <span class="d-block text-10 text-dark mt-2 mb-3">{{ $user->transaction }}</span>
                <p class="mb-0">Total Transaction</p>
              </div>
            </div>

            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
              <div class="border rounded p-3 text-center">
                <span class="d-block text-10 text-dark mt-2 mb-3">{{ $user->transaction_amount }}</span>
                <p class="mb-0">Transaction Amount</p>
              </div>
            </div>

            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
              <div class="border rounded p-3 text-center">
                <span class="d-block text-10 text-dark mt-2 mb-3">{{ $user->total_recipient }}</span>
                <p class="mb-0">Total Recipeint</p>
              </div>
            </div>

            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
              <div class="border rounded p-3 text-center">
                <span class="d-block text-10 text-dark mt-2 mb-3">{{ $user->refers }}</span>
                <p class="mb-0">Total Refer</p>
              </div>
            </div>

          </div>
        </div>

        <div class="bg-light shadow-sm rounded pt-4">
          <h3 class="text-5 font-weight-400 align-items-center px-4 mb-3">List of Transactions</h3>
          <form class="pb-3" method="get" action="{{ route('userpanel_transaction_index') }}">
            <div class="row">
              <div class="col-md-4">
                <input type="date" name="from_date" class="form-control m-3" value="{{ $filter->from_date ?? '' }}" required>
              </div>
              <div class="col-md-4">
                <input type="date" name="to_date" class="form-control m-3" value="{{ $filter->to_date ?? '' }}" required>
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-success m-3">Filter</button>
              </div>
            </div>
          </form>
          
          <table id="transactionTable" class="table table-hover">
            <thead>
              <tr>
                <th width="15%">Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Payment Method</th>
                <th>Amount</th>
                <th>Received Amount</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th colspan="10">{{ $transactions->links() }}</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($transactions as $transaction)
                <tr class="tr_modal{{ $transaction->id }}" style="cursor: pointer;">
                  <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                  <td>{{ $transaction->recipient->name }}</td>
                  <td>{{ $transaction->recipient->email }}</td>
                  <td>{{ $transaction->recipient->number }}</td>
                  <td>
                    @if ($transaction->status)
                      <span class="text-success" data-toggle="tooltip" data-original-title="Completed"><i class="fas fa-check-circle"></i></span>
                    @else
                      <span class="text-warning" data-toggle="tooltip" data-original-title="Pending"><i class="fas fa-ellipsis-h"></i></span>
                    @endif
                  </td>
                  <td>{{ $transaction->payment_method->name }}</td>
                  <td>${{ $transaction->amount }}</td>
                  <td>৳{{ $transaction->recipient_amount }}</td>
                </tr>
              @endforeach
            </tbody>  
          </table>
          
          @foreach ($transactions as $transaction)
            <div id="transaction_detail{{ $transaction->id }}" class="modal fade" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="row no-gutters">
                      <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-left py-4">
                        <div class="my-auto text-center">
                          <div class="text-17 text-white my-3"><i class="fas fa-building"></i></div>
                          <div class="text-8 font-weight-500 text-white my-4">${{ $transaction->amount }}</div>
                          <p class="text-white">{{ $transaction->created_at->format('d F Y') }}</p>
                        </div>
                      </div>
                      <div class="col-sm-7">
                        <h5 class="text-5 font-weight-400 m-3">Transaction Details
                          <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </h5>
                        <hr>
                        <div class="px-3">
                          <ul class="list-unstyled">
                            <li class="mb-2">Payment Amount <span class="float-right text-3">${{ $transaction->amount }}</span></li>
                            <li class="mb-2">Received Amount <span class="float-right text-3">৳{{ $transaction->recipient_amount }}</span></li>
                          </ul>
                          <hr class="mb-2">
                          <p class="d-flex align-items-center font-weight-500 mb-4">Total Paid (including fees) <span class="text-3 ml-auto">${{ $transaction->grand_total }}</span></p>
                          <ul class="list-unstyled">
                            <li class="font-weight-500">Recipient:</li>
                            <li class="text-muted">{{ $transaction->recipient->name }}</li>
                          </ul>
                          <ul class="list-unstyled">
                            <li class="font-weight-500">Phone:</li>
                            <li class="text-muted">{{ $transaction->recipient->number }}</li>
                          </ul>
                          <ul class="list-unstyled">
                            <li class="font-weight-500">Transaction ID:</li>
                            <li class="text-muted">{{ $transaction->order_id }}</li>
                          </ul>
                          <ul class="list-unstyled">
                            <li class="font-weight-500">Status:</li>
                            <li class="text-muted">{{ $transaction->status ? 'Completed' : 'Pending' }}</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
  
@stop

@section('scripts')

  <script type="text/javascript">
    $('.menu_profile').addClass('active');
    $('.userpanel_menu_transaction').addClass('active');

    $('.dropify').dropify();
  </script>

  <script type="text/javascript">
    @foreach ($transactions as $transaction)    
      $(document).on('click', '.tr_modal{{ $transaction->id }}', function() {
        $('#transaction_detail{{ $transaction->id }}').modal('show');
      });
    @endforeach
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

  <script type="text/javascript">
    $(document).ready( function () {
        $('#transactionTable').DataTable({
          dom: 'Bfrtip',
          buttons: [
              'print'
          ],
          bInfo : false,
          paging: false

        });
    });
  </script>

@stop