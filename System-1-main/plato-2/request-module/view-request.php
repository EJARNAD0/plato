<h3>Request Management</h3>
<div class="btn-box">
    <a class="btn-jsactive" onclick="document.getElementById('id03').style.display='block'">
        <i class="fas fa-user-edit"></i> Update Request Status
    </a> |
    <a class="btn-jsactive" onclick="document.getElementById('id02').style.display='block'">
        <i class="fas fa-lock"></i> Update Request Details
    </a>
</div>
<br/>
<div id="form-block">
    <form method="POST" action="processes/process.request.php?action=update">
        <div id="form-block-half">
            <label for="requester_name">Requester Name</label>
            <input type="text" id="requester_name" class="input" name="requester_name" value="<?php echo $req['user_firstname'] . ' ' . $req['user_lastname']; ?>" disabled placeholder="Requester name..">

            <label for="request_details">Request Details</label>
            <textarea id="request_details" class="input" name="request_details" placeholder="Details.."><?php echo $req['request_details']; ?></textarea>
        </div>

        <div id="form-block-half">
            <label for="status">Request Status</label>
            <select id="status" name="status">
                <option value="pending" <?php if ($req['request_status'] == "Pending") { echo "selected"; } ?>>Pending</option>
                <option value="approved" <?php if ($req['request_status'] == "Approved") { echo "selected"; } ?>>Approved</option>
                <option value="rejected" <?php if ($req['request_status'] == "Rejected") { echo "selected"; } ?>>Rejected</option>
            </select>
            <input type="hidden" name="request_id" value="<?php echo $req['request_id']; ?>" />
        </div>
        
        <br/><br/>
        <div id="button-block">
            <input type="submit" value="Update Request">
        </div>
    </form>
</div>

<div id="id01" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Update Request Status</h2>
    </div>
    <div class="modal-body">
      <p>Are you sure you want to update the request status?</p>
      <div class="modal-footer">
        <button class="confirmbtn" onclick="updateStatus()">Confirm</button>
        <button class="cancelbtn" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div id="id02" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Update Request Details</h2>
    </div>
    <div class="modal-body">
      <p>Provide the updated request details...</p>
      <form method="POST" id="requestForm" action="processes/process.request.php?action=updateDetails">
        <input type="hidden" name="request_id" value="<?php echo $req['request_id']; ?>" />
        <label for="new_details">New Request Details</label>
        <textarea id="new_details" class="input" name="new_details" placeholder="New details..."><?php echo $req['request_details']; ?></textarea>
      </form>
      <div class="modal-footer">
        <button class="submitbtn" onclick="requestSubmit()">Confirm</button>
        <button class="cancelbtn" onclick="document.getElementById('id02').style.display='none'">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
  function updateStatus() {
      // Logic to update the request status
      window.location.href = "processes/process.request.php?action=updateStatus&id=<?php echo $req['request_id']; ?>&status=new_status";
  }

  function requestSubmit() {
    document.getElementById("requestForm").submit();
  }

  // Close modal if user clicks outside of it
  window.onclick = function(event) {
    if (event.target == document.getElementById('id01')) {
      document.getElementById('id01').style.display = "none";
    } else if(event.target == document.getElementById('id02')){
      document.getElementById('id02').style.display = "none";
    }
  }
</script>
