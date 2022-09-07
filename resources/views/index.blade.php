<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
              integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" rel="stylesheet">
        <title>Phonebook</title>
    </head>

    <body>
        <div class="container-fluid" style="margin-top: 10px">
            <div class="row">
                <div class="col table-responsive">
                    <table class="table table-hover table-striped text-center"
                           style="position: relative; table-layout: fixed">
                        <thead>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
            </div>
            <div class="row text-center mb-2">
                <div class="col">
                    <button type="button" class="btn btn-success btn-block" onclick="addContact()">Add New Contact</button>
                </div>
            </div>
        </div>

        @include('modals.contact-modal')
        @include('modals.confirmation-modal')

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.js"></script>

        <script type="text/javascript">
{{--            var url = "{{ config('app.url') }}/api/";--}}
            function populateContact()
            {
                let contacts = null;
                $.ajax({
                    url: "http://127.0.0.1:8000/api/contacts",
                    method: "get",
                    success: function (response)
                    {
                        console.log(response);
                        contacts = response.data;
                        displayContacts(contacts);
                    },

                    error: function (error)
                    {
                        console.log(response);
                    },
                });
            }

            function displayContacts(contacts)
            {
                for(let i = 0; i < contacts.length; i++)
                {
                    $("#tbody").append('<tr> <td>'+ contacts[i].name + '</td> <td>' +
                        contacts[i].phone + '</td> <td>' + contacts[i].email + '</td> <td>' +
                        '<button class="btn btn-primary" type="button" onclick="findContact(' + contacts[i].id + ')">View</button>' +
                        '<button class="btn btn-danger" type="button" onclick="confirmDelete(' + contacts[i].id + ')">Delete</button>' + '</tr>');
                }
            }

            function findContact(id)
            {
                $.ajax({
                    url: "http://127.0.0.1:8000/api/contact/" + id,
                    method: "get",

                    success: function(response)
                    {
                        console.log(response);
                        showContact(response.data);
                    },

                    error: function (error)
                    {
                        console.log(error);
                    },
                });
            }

            function showContact(contact)
            {
                $("#inputName").val(contact.name);
                $("#inputEmail").val(contact.email);
                $("#inputPhone").val(contact.phone);
                $("#modalContacts").modal('show');
            }

            function saveContact()
            {
                $.ajax({
                    url: "http://127.0.0.1:8000/api/contact",
                    method: "post",
                    dataType: "json",

                    success: function(response)
                    {
                        console.log(response);
                        console.log("save");
                    },

                    error: function(error)
                    {
                        console.log(error);
                        console.log("save error");
                    }
                });
                hideModal();
            }

            function confirmDelete(id)
            {
                $.ajax({
                    url: "http://127.0.0.1:8000/api/contact/" + id,
                    method: "get",

                    success: function(response)
                    {
                        console.log(response);
                        let contact = response.data;
                        $("#contactID").val(contact.id);
                        $("#confirmModalBody").html("Do you really want to delete the record of " + contact.name + "!" +
                        "<input type='hidden' value='" + contact.id + "' id='contactID' >");
                        $("#confirmationModal").modal('show');
                    },

                    error: function (error)
                    {
                        console.log(error);
                    },
                });
            }

            function deleteContact()
            {
                let id = $("#contactID");
                $.ajax({
                    url: "http://127.0.0.1:8000/api/contact/" + id,
                    method: "delete",

                    success: function ()
                    {
                        console.log("Done");
                    },

                    error: function ()
                    {
                        console.log("Error");
                    }
                });

                location.reload(true);
                // populateContact();
            }

            function addContact()
            {
                $("#inputName").val(null);
                $("#inputPhone").val(null);
                $("#inputEmail").val(null);
                let btn = $("#saveBtn").html("Save");
                $("#modalContacts").modal('show');
            }

            function hideModal()
            {
                $("#modalContacts").modal('hide');
            }

            // function createViewBtn()
            // {
            //     $(document.createElement('button')).prop({
            //         type: 'button',
            //         innerHTML: 'View',
            //         class: 'btn btn-primary'
            //     })
            // }

            $(document).ready(function () {
                populateContact();
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
</html>
