<div class="modal fade" id="ModalEditData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">แก้ไขข้อมูล</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_update_data">
                <div class="modal-body">
                    <input type="hidden" id="id" value="">
                    <div class="mb-3">
                        <label for="editProductname" class="form-label">ชื่อสินค้า</label>
                        <input type="text" class="form-control" id="editProductname">
                    </div>
                    <div class="mb-3">
                        <label for="editDetail" class="form-label">รายละเอียด</label>
                        <textarea  id="editDetail" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editQuantity" class="form-label">จำนวนสินค้า</label>
                        <input type="number" class="form-control" id="editQuantity">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
