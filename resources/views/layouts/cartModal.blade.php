<!-- Cart Modal-->
<div class="modal fade" id="cart_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold">Sepetiniz</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('orders.create') }}" method="post">
                @csrf
                <div class="modal-body">

                    <div id="empty_cart_message"></div>
                    <ul class="list-group list-group-flush" id="cartList">


                    </ul>
                    <hr>
                    <div class="float-right font-weight-bold mr-4" id="total_price"></div>
                    <div class="mb-4"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="submit" id="confirm_cart" class="btn btn-danger">Sepeti Onayla</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
