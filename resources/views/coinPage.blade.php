@extends('layouts')
@section('link')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Shop</title>
@endsection
@section('main')
  <div class="modal fade" id="Coin-5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form method="POST" action="{{ route('goCoin') }}">
                        {{csrf_field()}}
                     <input style="font-size: 40px;color:gold;" type="number" name="price" id="exampleModalLabel" disabled>
                    {{--  <button class="btn btn-primary">BUY COINS</button> --}}
                                    </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                    	<button class="btn btn-success">ოპარაციის დასრულება</button>
                </form>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">დახურვა</button>
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
          <img src="Images/coins.png" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>5</h3>
            <p>1 GEL</p>
           <button  value="10" type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn1">შეძენა</button>
          </div>
        </article>
        <article>
          <img src="Images/coins.png" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>10</h3>
          <p>2 GEL</p>
            <button  value="10" type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn2">შეძენა</button>
          </div>
        </article>
        <article>
          <img src="Images/coins.png" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>20</h3>
        <p>4 GEL</p>
        <button value="20" type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn3">შეძენა</button>
          </div>
        </article>
        <article>
          <img src="Images/coins.png" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>25</h3>
       <p>5 GEL</p>
       <button value="25" type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn4">შეძენა</button>
          </div>
        </article>
        <article>
          <img src="Images/coins.png" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>50</h3>
        <p> 10 GEL</p>
        <button value="50" type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn5">შეძენა</button>
          </div>
        </article>
        <article>
          <img src="Images/coins.png" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>75</h3>
         <p> 15 GEL</p>
         <button type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn6">შეძენა</button>
          </div>
        </article>
        <article>
        <img src="Images/coins.png" alt="Coin" width="150" height="150">
        <div class="text">
          <h3>100</h3>
        <p> 20 GEL</p>
        <button type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn7">შეძენა</button>
        </div>
      </article>
      <article>
          <img src="Images/coins.png" alt="Coin" width="150" height="150">
          <div class="text">
            <h3>250</h3>
          <p> 50 GEL</p>
          <button type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn8">შეძენა</button>
          </div>
        </article>
        <article>
            <img src="Images/coins.png" alt="Coin" width="150" height="150">
            <div class="text">
              <h3>375</h3>
            <p> 75 GEL</p>
            <button type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn9">შეძენა</button>
            </div>
          </article>
          <article>
              <img src="Images/coins.png" alt="Coin" width="150" height="150">
              <div class="text">
                <h3>500</h3>
              <p> 100 GEL</p>
              <input type="hidden" value="500" name="coin">
              <button type="button" class="btn" data-toggle="modal" data-target="#Coin-5" id="btn10">შეძენა</button>
              </div>
            </article>
      </div>
@endsection
@section('script')
	<script>
        $(document).ready(function(){
        $("#btn1").click(function(){
          var elem = document.getElementById("exampleModalLabel");
          elem.value = "5";
        });
        $("#btn2").click(function(){
          var elem = document.getElementById("exampleModalLabel");
          elem.value = "10";
        });
        $("#btn3").click(function(){
          var elem = document.getElementById("exampleModalLabel");
          elem.value = "20";
        });
        $("#btn4").click(function(){
         var elem = document.getElementById("exampleModalLabel");
          elem.value = "25";
        });
        $("#btn5").click(function(){
         var elem = document.getElementById("exampleModalLabel");
          elem.value = "50";
        });
        $("#btn6").click(function(){
          var elem = document.getElementById("exampleModalLabel");
          elem.value = "75";
        });
        $("#btn7").click(function(){
          var elem = document.getElementById("exampleModalLabel");
          elem.value = "100";
        });
        $("#btn8").click(function(){
          var elem = document.getElementById("exampleModalLabel");
          elem.value = "250";
        });
        $("#btn9").click(function(){
          var elem = document.getElementById("exampleModalLabel");
          elem.value = "375";
        });
        $("#btn10").click(function(){
          var elem = document.getElementById("exampleModalLabel");
          elem.value = "500";
        });
      });
      </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection