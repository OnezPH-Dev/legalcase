<div class="modal fade" id="addCase" tabindex="-1" aria-labelledby="addmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addModal">Add New Adminstrative Case</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form id="addcase-form" enctype="multipart/form-data">

            <div class="form-group mb-3">
                <label for="name">Company Name</label>
                <input type="text" id="name" class="form-control" name="name" >
            </div>
            <div class="form-group mb-3">
                <label for="address">Company Address</label>
                <input type="text" id="address" class="form-control" name="address" >
            </div>
            <div class="form-group mb-3">
                <label for="caseNmber">Case Number</label>
                <input type="text" id="caseNmber" class="form-control" name="casenumber" >
            </div>
            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select class="form-select" id="status"  name="status" aria-label="Default select example">
                    <option value="" disabled selected>Choose Status...</option>
                    <option value="Decided but no payment">Decided but no payment</option>
                    <option value="Paid fines and penalties">Paid fines and penalties</option>
                    <option value="Under Litigation / Pending">Under Litigation / Pending</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="legalcase" class="form-label">Legal Case File</label>
                <input class="form-control" name="legalcasefile" type="file" id="legalcase" accept=".pdf">
            </div>
            <div class="form-group"  align="end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="save_case" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
