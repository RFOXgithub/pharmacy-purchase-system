function editButton() {
    $(document).on('click', '.editButton', function(event) {
      event.preventDefault();
  
      if (!$(this).hasClass('disabled')) {
        const url = $(this).data('url');
        const id_checkout = this.getAttribute("data-id");
        const payment_status = this.getAttribute("data-status");
  
        Swal.fire({
          title: "Edit Checkout Data",
          html: `
            <form id="editForm">
              <div class="form-group">
                <label for="payment_status">Status:</label>
                <select id="payment_status" class="form-control" name="payment_status">
                  <option value="Pending" ${payment_status === "Pending" ? "selected" : ""}>Pending</option>
                  <option value="Paid" ${payment_status === "Paid" ? "selected" : ""}>Paid</option>
                  <option value="Declined" ${payment_status === "Declined" ? "selected" : ""}>Declined</option>
                </select>
              </div>
            </form>
          `,
          showCancelButton: true,
          confirmButtonText: "Simpan",
          cancelButtonText: "Batal",
          preConfirm: () => {
            const statusInput = document.getElementById("payment_status").value;
  
            if (!statusInput || !["Pending", "Paid", "Declined"].includes(statusInput)) {
              Swal.showValidationMessage("Status tidak valid");
              return false;
            }
  
            return { id_checkout, payment_status: statusInput };
          },
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: url,
              method: "POST",
              data: result.value,
              success: function(response) {
                try {
                  response = typeof response === "string" ? JSON.parse(response) : response;
  
                  if (response.status === "success") {
                    Swal.fire({
                      title: "Berhasil!",
                      text: response.message,
                      icon: "success"
                    }).then(() => {
                      location.reload();
                    });
                  } else {
                    Swal.fire("Gagal!", response.message || "Terjadi kesalahan.", "error");
                  }
                } catch (e) {
                  Swal.fire("Gagal!", "Terjadi kesalahan saat mengupdate data.", "error");
                }
              },
              error: function(xhr, status, error) {
                Swal.fire("Gagal!", `Terjadi kesalahan saat mengupdate data. Status: ${status}, Error: ${error}`, "error");
              },
            });
          }
        });
      }
    });
  }
  
  document.addEventListener('DOMContentLoaded', function() {
    editButton();
  });