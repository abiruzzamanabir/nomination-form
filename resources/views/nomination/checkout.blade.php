<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center g-2 mt-3">
            <div class="col-md-8">
                @include('validate')

                <div>
                    @if ($payment==2)
                    <h1 class="text-center text-white">Paid Successfully!</h1>
                    <h4 class="text-center text-white">This Order ID: <b>{{$ukey}}</b> is paid successfully by online payment
                        system.</h4>

                    @elseif ($invoice!=null)
                    <h1 class="text-center text-white">Thank You!</h1>
                    <h4 class="text-center text-white">This Order ID: <b>{{$ukey}}</b> is already submitted by Cash Payment.
                    </h4>
                    @else
                    <h4 class="text-center"><b class="text-uppercase">Order ID:</b> {{$ukey}}</h4>
                    <h6 class="text-center">Pay Your Nomination Fees</h6>
                    <h3 class="text-muted">Your Cart</h3>
                    <table class="table">
                        <tbody class="border">
                            <tr>
                                <td>Nomination Fee</td>
                                <td class="text-end text-muted">BDT 12,500</td>
                            </tr>
                            <tr>
                                <td>VAT (15%)</td>
                                <td class="text-end text-muted">BDT 1,875</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td class="text-end"><b>BDT 14,375</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <b>Card Payment / Mobile Banking / Internet Banking</b>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <u>
                                    <h4 class="text-center">Your Information</h4>
                                </u>
                                <table class="table">
                                    <tbody class="border">
                                        <tr class="table-primary">
                                            <td>Name: </td>
                                            <td class="text-end">{{$name}}</td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td>Email</td>
                                            <td class="text-end">{{$email}}</td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td>Phone</td>
                                            <td class="text-end">{{$phone}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <form action="{{ route('pay') }}" method="POST">
                                    @csrf
                                    <input class="form-control my-2" type="hidden" value="{{$ukey}}" name="uid"
                                        id="uid">
                                    <input class="form-control my-2" type="hidden" value="{{$ukey}}" name="ukey"
                                        id="ukey">
                                    <input class="form-control my-2" type="hidden" value="{{$name}}" name="name"
                                        id="customer_name">
                                    <input class="form-control my-2" type="hidden" value="{{$email}}" name="email"
                                        id="email">
                                    <input class="form-control my-2" type="hidden" value="{{$phone}}" name="phone"
                                        id="mobile">
                                    <input class="form-control my-2" type="hidden" value="14375" name="total"
                                        id="total_amount">
                                    <button style="width: 100%" class="btn btn-primary" postdata=""
                                        endpoint="/pay-via-ajax"> Pay Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><b>Cash
                                    Payment (Click To Open)</b>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <u>
                                    <h4 class="text-center">Your Information</h4>
                                </u>
                                <table class="table">
                                    <tbody class="border">
                                        <tr class="table-primary">
                                            <td>Name: </td>
                                            <td class="text-end">{{$name}}</td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td>Email</td>
                                            <td class="text-end">{{$email}}</td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td>Phone</td>
                                            <td class="text-end">{{$phone}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <form action="{{ route('form.update',$ukey)}}" method="POST" class="was-validated">
                                    @csrf
                                    @method('PUT')
                                    <input class="form-control my-2" type="hidden" value="{{$ukey}}" name="uid"
                                        id="uid">
                                    <input class="form-control my-2" type="hidden" value="{{$ukey}}" name="ukey"
                                        id="ukey">
                                    <input class="form-control my-2" type="hidden" value="{{$name}}" name="name"
                                        id="customer_name">
                                    <input class="form-control my-2" type="hidden" value="{{$email}}" name="email"
                                        id="email">
                                    <input class="form-control my-2" type="hidden" value="{{$phone}}" name="phone"
                                        id="mobile">
                                    <div class="mb-3">
                                        <label for="validationName" class="form-label">Invoice Number</label>
                                        <input type="text" name="invoice" class="form-control" required>
                                        <div class="invalid-feedback">Enter Your Invoice Number</div>
                                    </div>
                                    <div class="mb-3">
                                        <button style="width: 100%" class="btn btn-primary"
                                            type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        var obj = {};
    obj.cus_id = $('#uid').val();
    obj.cus_keu = $('#ukey').val();
    obj.cus_name = $('#customer_name').val();
    obj.cus_phone = $('#mobile').val();
    obj.cus_email = $('#email').val();
    obj.cus_addr1 = $('#address').val();
    obj.amount = $('#total_amount').val();
    
    $('#sslczPayBtn').prop('postdata', obj);
    </script>

    <script>
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                tag.parentNode.insertBefore(script, tag);
            };
    
            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>