$(document).ready(function(){
    //when + btn click
    $(".btn-plus").click(function(){
        $parentNode = $(this).parents('tr')
        $price =Number($parentNode.find('#price').text().replace("Ks",""));
        $qty = Number($parentNode.find('#qty').val()) ;
       
        $total = $price * $qty;
        $parentNode.find('#total').html($total);

        summaryCalculation()

        

    })
    $(".btn-minus").click(function(){

        //when + btn click
        $parentNode = $(this).parents('tr')
        $price =Number($parentNode.find('#price').text().replace("Ks",""));
        $qty = Number($parentNode.find('#qty').val());

        $total = $price * $qty;

        $parentNode.find('#total').html($total);

        summaryCalculation()
    })

    //when cross btn click

    $(".btnRemove").click(function(){
        $parentNode = $(this).parents('tr')
        $parentNode.remove();

        summaryCalculation()
    })
     //final calculation
    function summaryCalculation(){
        $totalPrice = 0;
        $("#dataTable tr").each(function(index,row){
            $totalPrice +=Number($(row).find('#total').text().replace('Ks',''));
            
        })
        $('#subTotal').html(`${$totalPrice} Kyats`)
        $('#finalPrice').html(`${$totalPrice+3000} Kyats`)
    }
})
