<?php
include "../connection.php";

// change $con to whatever your connection variable is
$result = mysqli_query($connection, "SELECT * FROM contact_queries ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>User Contact Queries</title>
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #f4f6f9;
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

th {
    background: #1f2d3d;
    color: white;
    padding: 12px;
}

td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    vertical-align: top;
}

tr:hover {
    background: #f1f5f9;
}

textarea {
    width: 100%;
    min-height: 60px;
    padding: 6px;
    resize: vertical;
}

button {
    margin-top: 5px;
    background: #0d6efd;
    color: white;
    border: none;
    padding: 6px 12px;
    cursor: pointer;
    border-radius: 4px;
}

button:hover {
    background: #084298;
}

.status-pending {
    color: orange;
    font-weight: bold;
}

.status-replied {
    color: green;
    font-weight: bold;
}

.reply-box {
    background: #f8f9fa;
    padding: 6px;
    border-radius: 4px;
    margin-top: 5px;
    font-size: 14px;
}
</style>
</head>
<body>

<h2>📩 User Contact Queries</h2>

<table>
<tr>
    <th>ID</th>
    <th>User</th>
    <th>Subject</th>
    <th>Message</th>
    <th>Date</th>
    <th>Status</th>
    <th>Admin Reply</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td>
        <b><?php echo $row['name']; ?></b><br>
        <small><?php echo $row['email']; ?></small>
    </td>
    <td><?php echo $row['subject']; ?></td>
    <td><?php echo $row['message']; ?></td>
    <td><?php echo $row['created_at']; ?></td>

    <td>
        <?php if($row['status']=="Replied"){ ?>
            <span class="status-replied">Replied</span>
        <?php } else { ?>
            <span class="status-pending">Pending</span>
        <?php } ?>
    </td>

    <td>
        <?php if($row['admin_reply']) { ?>
            <div class="reply-box">
                <?php echo $row['admin_reply']; ?>
            </div>
        <?php } ?>

        <form action="reply.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <textarea name="reply" placeholder="Type reply..." required></textarea>
            <button type="submit">Send Reply</button>
        </form>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
