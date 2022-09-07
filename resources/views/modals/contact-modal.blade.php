<div class="modal fade" id="modalContacts" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Contact Display</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-striped text-center">
                    <tbody>
                    <tr>
                        <input type="hidden" id="showContactID">
                    </tr>
                    <tr>
                        <td><label for="inputName">Name</label></td>
                        <td><input class="form-control" type="text" name="name" id="inputName" placeholder="Enter name here"></td>
                    </tr>

                    <tr>
                        <td><label for="inputPhone">Phone</label></td>
                        <td><input class="form-control" type="text" name="phone" id="inputPhone" placeholder="Enter phone number here"></td>
                    </tr>

                    <tr>
                        <td><label for="inputEmail">Email</label></td>
                        <td><input class="form-control" type="email" name="email" id="inputEmail" placeholder="Enter email here"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
                <button onclick="saveContact()" id="saveBtn" type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>
