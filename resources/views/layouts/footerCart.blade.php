
<script type="application/javascript">
    var _token = '<?php echo csrf_token() ?>';
    $(document).ready(function() {
            @if(!preg_match("/login/", $_SERVER['REQUEST_URI']))
            @if(preg_match('!html!', $_SERVER['REQUEST_URI']))
            $("body").on("click","#modal-size .data-size", function( event ) {
                var id = $(this).attr('attr');
                $("#modal-size .data-size").removeClass("selected");
                $(this).addClass("selected");
                $('#size'+id).checked = true;
                var tempsize = document.getElementById('size'+id);
                if(tempsize.disabled==false) {
                    tempsize.checked = true;
                }
            });


        @endif
        function search_line(line) {
            var sea = $( line);
            var li = $( '#search_mob');
            sea.show();
            li.hide();
            $( ".search-line" ).show();
        }



        /*   var wishlist = new Vue({
               el: '#wishlist',
               data: {
                   details: {
                       sub_total: 0,
                       total: 0,
                       total_quantity: 0
                   },
                   itemCount: 0,
                   items: [],
                   item: {
                       id: '',
                       name: '',
                       price: 0.00,
                       qty: 1
                   }
               },
               mounted:function(){
                   this.loadItems();
               },
               methods: {
                   addItem: function() {

                       var _this = this;

                       this.$http.post('/wishlist',{
                           _token:_token,
                           id:_this.item.id,
                           name:_this.item.name,
                           price:_this.item.price,
                           qty:_this.item.qty
                       }).then(function(success) {
                           _this.loadItems();
                       }, function(error) {
                           console.log(error);
                       });
                   },
                   removeItem: function(id) {

                       var _this = this;

                       this.$http.delete('/wishlist/'+id,{
                           params: {
                               _token:_token
                           }
                       }).then(function(success) {
                           _this.loadItems();
                       }, function(error) {
                           console.log(error);
                       });
                   },
                   loadItems: function() {

                       var _this = this;

                       this.$http.get('/wishlist',{
                           params: {
                               limit:10
                           }
                       }).then(function(success) {
                           _this.items = success.body.data;
                           _this.itemCount = success.body.data.length;
                           _this.loadCartDetails();
                       }, function(error) {
                           console.log(error);
                       });
                   },
                   loadCartDetails: function() {

                       var _this = this;

                       this.$http.get('/wishlist/details').then(function(success) {
                           _this.details = success.body.data;
                       }, function(error) {
                           console.log(error);
                       });
                   }
               }
           });*/
        @endif
            @if(preg_match('!html!', $_SERVER['REQUEST_URI']))





        @endif


    });

</script>


