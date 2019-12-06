@extends('layouts')
@section('link')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    <link rel="stylesheet" href="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') }}">
    <title>Shop</title>
@endsection
@section('main')
<style type="text/css">
.logout{
    
   float:right;
   margin-top:-3.7%;
}
</style>
  <div class="modal fade" style="visibility: visible;" id="Coin-5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
                <div class="modal-dialog" role="document" style="margin-left: 300px;">
                  <div class="modal-content" style="width: 800px;">
                    <div class="modal-header">

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                            <div class="card">
                                    <div class="card-body">
              {{--   <form method="POST" action="{{ route('goCoin') }}">
                        {{csrf_field()}} --}}
                     <input style="font-size: 40px;color:gold;" type="number" name="price" class="coinAmount" id="exampleModalLabel" disabled>
                    {{--  <button class="btn btn-primary">BUY COINS</button> --}}
                                    </div>
                            </div>
                    </div>  
                    <div class="modal-footer">
                    	<button class="btn btn-success" id="buyCoins">ოპარაციის დასრულება</button>
                {{-- </form> --}}
                      <button type="button" id="daxurva" class="btn btn-secondary" data-dismiss="modal">დახურვა</button>
                    </div>
                  </div>
                </div>
              </div>
        <div class="coins-header">

                <h1>
                  ჩაურიცხე სტრიმერს ქოინები და მიიღე 10% ქეშბექი 
                </h1>
          </div>

    <div class="donate-grid">
        <article>
          <img src="{{ asset('Images/coins.png') }}" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>100</h3>
            <p>1 GEL</p>
           <button  type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn1">შეძენა</button>
          </div>
        </article>
                <article>
          <img src="{{ asset('Images/coins.png') }}" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>200</h3>
            <p>2 GEL</p>
           <button  type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn2">შეძენა</button>
          </div>
        </article>
                <article>
          <img src="{{ asset('Images/coins.png') }}" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>400</h3>
            <p>4 GEL</p>
           <button  type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn3">შეძენა</button>
          </div>
        </article>
                <article>
          <img src="{{ asset('Images/coins.png') }}" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>700</h3>
            <p>7 GEL</p>
           <button  type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn4">შეძენა</button>
          </div>
        </article>
                <article>
          <img src="{{ asset('Images/coins.png') }}" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>1100</h3>
            <p>11 GEL</p>
           <button  type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn5">შეძენა</button>
          </div>
        </article>
                <article>
          <img src="{{ asset('Images/coins.png') }}" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>1250</h3>
            <p>13 GEL</p>
           <button  type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn6">შეძენა</button>
          </div>
        </article>
                <article>
          <img src="{{ asset('Images/coins.png') }}" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>2100</h3>
            <p>21 GEL</p>
           <button  type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn7">შეძენა</button>
          </div>
        </article>
                        <article>
          <img src="{{ asset('Images/coins.png') }}" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>3250</h3>
            <p>32 GEL</p>
           <button  type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn8">შეძენა</button>
          </div>
        </article>
                        <article>
          <img src="{{ asset('Images/coins.png') }}" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>4375</h3>
            <p>43 GEL</p>
           <button  type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn9">შეძენა</button>
          </div>
        </article>
         <article>
          <img src="{{ asset('Images/coins.png') }}" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>5000</h3>
            <p>50 GEL</p>
           <button  type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn10">შეძენა</button>
          </div>
        </article>
      </div>
@endsection

@section('script')

	<script>

        $("#btn1").click(function(){
            $('#exampleModalLabel').val(100);
        });
        $("#btn2").click(function(){
            $('#exampleModalLabel').val(200);
        });
        $("#btn3").click(function(){
            $('#exampleModalLabel').val(400);
        });
        $("#btn4").click(function(){
            $('#exampleModalLabel').val(700);
        });
        $("#btn5").click(function(){
            $('#exampleModalLabel').val(1100);
        });
        $("#btn6").click(function(){
            $('#exampleModalLabel').val(1250);
        });
        $("#btn7").click(function(){
            $('#exampleModalLabel').val(2100);
        });
        $("#btn8").click(function(){
            $('#exampleModalLabel').val(3250);
        });
        $("#btn9").click(function(){
            $('#exampleModalLabel').val(4375);
        });
        $("#btn10").click(function(){
            $('#exampleModalLabel').val(5000);
        });
        

    $('#buyCoins').on('click',function(){
      var price = $('#exampleModalLabel').val();
      console.log(price);
      $.ajax({
        type:'POST',
        url:'{{ route('goCoin') }}',
        data:{
          _token:'{{ csrf_token() }}',
          price:price
        },
        success:function(){
            $('#Coin-5').modal('hide');
        }
      }).fail(function(){
        console.log('FAILED !!');
      });
    }); 
</script>
<script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js') }}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection