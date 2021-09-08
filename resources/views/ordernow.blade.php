@extends('layouts.app')
@section("content")
<div class="custom-product">
     <div class="col-sm-10">
         <div class="ordernow-page">
           <table class="table ">
            
            <tbody>
              <tr>
                <td>Amount</td>
                <td>$ {{ $total }}</td>
              </tr>
              <tr>
                <td>Tax</td>
                <td>$ 0</td>
              </tr>
              <tr>
                <td>Delivery</td>
                <td>$ 10</td>
              </tr>

              <tr>
                <td>Total amount</td>
                <td>$ {{ $total + 10 }}</td>
              </tr>
            </tbody>
          </table>
          <div class="">
            <form action="/orderplace" method="POST">
              @csrf
                <div class="form-group">
                  
                  <textarea name="address" placeholder="enter your address" class="form-control" > </textarea>
                </div>
                <div class="form-group">
                  <label for="pwd">Payment method: </label> <br>
                  <input type="radio" value="cash" name="payment"> <span>online payment</span><br>
                  <input type="radio" value="cash" name="payment"> <span>EMI payment</span><br>
                  <input type="radio" value="cash" name="payment"> <span>Payment on delivery</span>
                </div>
                
                <button type="submit" class="btn btn-default">Order Now</button>
              </form>
          </div>  
         </div>
        
     </div>
</div>
@endsection 