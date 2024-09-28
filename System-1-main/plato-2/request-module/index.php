<?php
$request_obj = new Request();  
// Fetch all requests
$all_requests = $request_obj->get_all_requests(); 
?>
<body>
<h1>All User Requests</h1>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Request Details</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($all_requests) && is_array($all_requests)): ?>
            <?php foreach ($all_requests as $req): ?>
            <tr>
                <td><?php echo $req['user_firstname'] . ' ' . $req['user_lastname']; ?></td>
                <td><?php echo $req['request_details']; ?></td>
                <td><?php echo ucfirst($req['request_status']); ?></td>
                <td><?php echo $req['created_at']; ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No requests found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</body>
</html>
