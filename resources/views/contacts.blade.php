<!DOCTYPE html>
<html>
<head>
    <title>Contact List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 500px;
            z-index: 2;
        }
        .popup input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .popup button {
            width: 100%;
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
        }
        .popup button:hover {
            background-color: #0056b3;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .add-contact {
            display: block;
            margin: 20px auto;
            color: #007BFF;
            text-decoration: none;
            font-size: 16px;
        }
        .add-contact:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Contact List</h2>
    <!-- Link to open the Add Contact popup -->
    <a href="#" class="add-contact" onclick="openPopup()">Add New Contact</a>

    @if(count($contacts) === 0)
        <p>No contacts found.</p>
    @else
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birthdate</th>
                <th>Work Phone</th>
                <th>Home Phone</th>
                <th>Email</th>
                <th>Created By ID</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
            @foreach ($contacts as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->firstname }}</td>
                    <td>{{ $row->lastname }}</td>
                    <td>{{ $row->birthdate }}</td>
                    <td>{{ $row->workphone }}</td>
                    <td>{{ $row->homephone }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->createdByID }}</td>
                    <td>{{ $row->createdDate }}</td>
                    <td>
                        <a href="#"
                           style="text-decoration:none"
                           onclick="openEditPopup(
                               '{{ $row->id }}',
                               '{{ $row->firstname }}',
                               '{{ $row->lastname }}',
                               '{{ $row->birthdate }}',
                               '{{ $row->workphone }}',
                               '{{ $row->homephone }}',
                               '{{ $row->email }}'
                           )">Edit</a>
                        &nbsp;|&nbsp;
                        <a href="{{ route('contacts.delete', $row->id) }}"
                           style="text-decoration:none"
                           onclick="return confirm('Are you sure you want to delete this contact?');">
                           Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    <!-- Add Contact Popup -->
    <div id="popup" class="popup">
        <h2>Add New Contact</h2>
        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="date" name="birthdate" required>
            <input type="text" name="workphone" placeholder="Work Phone">
            <input type="text" name="homephone" placeholder="Home Phone">
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit" onclick="return confirm('You sure want to add contact yikes?');">Add Contact</button>
            <button type="button" onclick="closePopup()">Cancel</button>
        </form>
    </div>

    <!-- Edit Contact Popup -->
    <div id="editPopup" class="popup">
        <h2>Edit Contact</h2>
        <form action="{{ route('contacts.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" id="edit_id">
            <input type="text" name="firstname" id="edit_firstname" placeholder="First Name" required>
            <input type="text" name="lastname" id="edit_lastname" placeholder="Last Name" required>
            <input type="date" name="birthdate" id="edit_birthdate" required>
            <input type="text" name="workphone" id="edit_workphone" placeholder="Work Phone">
            <input type="text" name="homephone" id="edit_homephone" placeholder="Home Phone">
            <input type="email" name="email" id="edit_email" placeholder="Email" required>
            <button type="submit" onclick="return confirm('U wanna edit bidet skibibi gyat?!')">Update Contact</button>
            <button type="button" onclick="closeEditPopup()">Cancel</button>
        </form>
    </div>

    <script>
        function openPopup() {
            document.getElementById("popup").style.display = "block";
        }
        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }
        function openEditPopup(id, firstname, lastname, birthdate, workphone, homephone, email) {
            document.getElementById("edit_id").value = id;
            document.getElementById("edit_firstname").value = firstname;
            document.getElementById("edit_lastname").value = lastname;
            document.getElementById("edit_birthdate").value = birthdate;
            document.getElementById("edit_workphone").value = workphone;
            document.getElementById("edit_homephone").value = homephone;
            document.getElementById("edit_email").value = email;
            document.getElementById("editPopup").style.display = "block";
        }
        function closeEditPopup() {
            document.getElementById("editPopup").style.display = "none";
        }
    </script>
</body>
</html>
