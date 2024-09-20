<div class="modal fade" id="viewCase" tabindex="-1" aria-labelledby="viewModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="viewModal">Adminstrative Case</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form id="update-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="vid" name="vid">
            <div class="form-group mb-3">
                <label for="name">Company Name</label>
                <input type="text" id="ename" class="form-control" name="vname">
            </div>
            <div class="form-group mb-3">
                <label for="address">Company Address</label>
                <input type="text" id="eaddress" class="form-control" name="vaddress">
            </div>
            <div class="form-group mb-3">
                <label for="caseNmber">Case Number</label>
                <input type="text" id="ecaseNmber" class="form-control" name="vcasenumber">
            </div>
            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select class="form-select" id="estatus" name="vstatus" aria-label="Default select example">
                    <option value="" disabled selected>Choose Status...</option>
                    <option value="Decided but no payment">Decided but no payment</option>
                    <option value="Paid fines and penalties">Paid fines and penalties</option>
                    <option value="Under Litigation / Pending">Under Litigation / Pending</option>
                </select>
            </div>
            <label for="status">Legal Case File</label>
            <div class="input-group mb-3" style="width: 100%">
                <a class="input-group-text text-primary" id="linkCase" target="_blank" href="">File Link</a>
                <input type="file" name="vlegalcasefile" class="form-control" id="inFile" accept=".pdf">
            </div>
            <div class="form-group"  align="end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="update" class="btn btn-primary">Update</button>
            </div>
        </form>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
