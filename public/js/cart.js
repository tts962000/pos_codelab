//add item
$(document).ready(function(){
    //when click plus btn
    $('.btn-plus').click(function(){
         $parentNode=$(this).parents("tr"); //find parent
         $price=Number($parentNode.find('#price').text().replace("kyats","")); //catch child
         $qty=Number($parentNode.find('#qty').val()); //catch child
         $total=$price*$qty; //solve
         $parentNode.find('#total').html(`${$total} kyats`); //display UI
        // total summary
        summaryCalculation();

        // console.log($parentNode.find(''))


    })
    //when minus plus btn
    $('.btn-minus').click(function(){
         $parentNode=$(this).parents("tr"); //find parent
         $price=Number($parentNode.find('#price').text().replace("kyats","")); //catch child
         $qty=Number($parentNode.find('#qty').val()); //catch child
         if($qty==0){
            $('.btn-minus').attr("diabled");
        }
         $total=$price*$qty; //solve
         $parentNode.find('#total').html(`${$total} kyats`); //display UI

         summaryCalculation();
    })


    //calculate final price
    function summaryCalculation(){
        $totalPrice=0;
         $('#dataTable tbody tr').each(function(index,row){
            $totalPrice+=Number($(row).find('#total').text().replace("kyats",""));
         });
        //  console.log($totalPrice);

         $("#subTotalPrice").html(`${$totalPrice} Kyats`);
         $("#finalPrice").html(`${$totalPrice+3000} Kyats`);
    }
})
