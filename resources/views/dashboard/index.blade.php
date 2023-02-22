<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nomination Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.2/datatables.min.css" />
    <script src="https://use.fontawesome.com/b477068b8c.js"></script>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


</head>

<body>

    {{-- <button id="sslczPayBtn" token="if you have any token validation" postdata=""
        order="If you already have the transaction generated for current order" endpoint="/pay-via-ajax"> Pay Now
    </button> --}}

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <a href="{{ route('trash.index') }}" class="btn btn-sm btn-danger">Trash</a>
                    </div>
                    <div class="card-body">
                        @include('validate')
                        <table id="dashboard" class="table table-striped border">
                            <thead>
                                <tr class="table-info">
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_nomination as $item)
                                <tr class="align-middle">
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td class="align-middle">
                                        <form action="{{ route('dashboard.update',$item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <textarea name="comment" id="" cols="20" rows="2" placeholder="Enter Your Comment Here....">{{$item->comment}}</textarea>
                                        <br>
                                        <button class="btn btn-info btn-sm btnsize" type="submit"><i
                                            class="fa fa-check" aria-hidden="true"></i></button>
                                        <a class="btn btn-info btn-sm btnsize" href="{{ route('comment.empty',$item->id) }}"><i
                                                class="fa fa-refresh" aria-hidden="true"></i></a>
                                    </form>
                                    </td>
                                    <td style="font-size: 12px">@if ($item->payment==2)
                                        <p>Paid Online<br><span class="badge bg-success">Online</span></p>
                                        @elseif ($item->invoice!=null)
                                            @if ($item->pv===0)
                                            <p>Cheque Payment<br>Invoice : <b>{{$item->invoice}}</b><br><span
                                                class="badge bg-danger">Payment Unverified</span>
                                                <a class="text-success btnsize" href="{{ route('payment.status.update',$item->ukey) }}"><i
                                                    class="fa fa-check" aria-hidden="true"></i></a>
                                            </p>
                                                
                                            @else
                                            <p>Cheque Payment<br>Invoice : <b>{{$item->invoice}}</b><br><span
                                                class="badge bg-success">Payment verified</span>
                                                <a class="text-danger btnsize" href="{{ route('payment.status.update',$item->ukey) }}"><i
                                                    class="fa fa-times" aria-hidden="true"></i></a>
                                            </p>
                                                
                                            @endif
                                        @else
                                        <form action="{{ route('dashboard.payment') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="name" readonly value="{{$item->name}}">
                                            <input type="hidden" name="email" readonly value="{{$item->email}}">
                                            <input type="hidden" name="phone" readonly value="{{$item->phone}}">
                                            <input type="hidden" name="ukey" readonly value="{{$item->ukey}}">
                                            <button type="submit" class="btn btn-info btn-sm btnsize">Send Mail For
                                                Payment</button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->trash)
                                        <a class="btn btn-sm btn-success" href="{{ route('trash.update',$item->ukey) }}"><i
                                                class="fa fa-undo" aria-hidden="true"></i></a>
                                        @else
                                        <a class="btn btn-sm btn-danger" href="{{ route('trash.update',$item->ukey) }}"><i
                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">Footer</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.2/datatables.min.js"></script>

    <script>
        $(document).ready(function () {
    $('#dashboard').DataTable();
});
    </script>
</body>

</html>