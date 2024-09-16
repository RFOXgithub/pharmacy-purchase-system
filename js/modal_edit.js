function editButton() {
document.querySelectorAll(".editButton").forEach((button) => {
  button.addEventListener("click", function () {
    const id = this.getAttribute("data-id");
    const catatan = this.getAttribute("data-catatan");
    const status = this.getAttribute("data-status");

    Swal.fire({
      title: "Edit Keluhan",
      html: `
        <form id="editForm">
          <div class="form-group">
            <label for="catatan">Catatan:</label>
            <textarea id="catatan" class="form-control" name="catatan">${catatan}</textarea>
          </div>
          <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" class="form-control" name="status">
              <option value="1" ${status === "1" ? "selected" : ""}>Pengajuan</option>
              <option value="2" ${status === "2" ? "selected" : ""}>Dibaca</option>
              <option value="3" ${status === "3" ? "selected" : ""}>Diproses</option>
              <option value="4" ${status === "4" ? "selected" : ""}>Selesai</option>
              <option value="5" ${status === "5" ? "selected" : ""}>Dibatalkan</option>
            </select>
          </div>
        </form>
      `,
      showCancelButton: true,
      confirmButtonText: "Simpan",
      cancelButtonText: "Batal",
      preConfirm: () => {
        const catatanInput = document.getElementById("catatan").value;
        const statusInput = document.getElementById("status").value;

        if (!catatanInput || !statusInput) {
          Swal.showValidationMessage("Harap isi semua field");
          return false;
        }

        if (!["1", "2", "3", "4", "5"].includes(statusInput)) {
          Swal.showValidationMessage("Status tidak valid");
          return false;
        }

        return { id, catatan: catatanInput, status: statusInput };
      },
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: editKeluhanUrl,
          method: "POST",
          data: result.value,
          success: function (response) {
            console.log("AJAX response:", response);
            try {
              if (typeof response === "string") {
                response = JSON.parse(response);
              }

              if (response && response.status) {
                if (response.status === "success") {
                  Swal.fire({
                    title: "Berhasil!",
                    text: response.message,
                    icon: "success"
                  }).then(() => {
                    location.reload();
                  });
                } else {
                  Swal.fire("Gagal!", response.message, "error");
                }
              } else {
                Swal.fire("Gagal!", "Format respons tidak valid.", "error");
              }
            } catch (e) {
              console.error("Error parsing JSON:", e);
              Swal.fire("Gagal!", "Terjadi kesalahan saat mengupdate data.", "error");
            }
          },
          error: function (xhr, status, error) {
            console.error("AJAX error:", status, error);
            Swal.fire("Gagal!", `Terjadi kesalahan saat mengupdate data. Status: ${status}, Error: ${error}`, "error");
          },
        });
      }
    });
  });
});
}

function editButtonPerawatan() {
  document.querySelectorAll(".editButtonPerawatan").forEach((button) => {
    button.addEventListener("click", function () {
      const id = this.getAttribute("data-id");
      const url = this.getAttribute("data-url");
      const tanggal_perawatan = this.getAttribute("data-tanggal_perawatan");

      Swal.fire({
        title: "Edit Tanggal Perawatan",
        html: `
        <form id="editForm">
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input id="tanggal_perawatan" class="form-control" name="tanggal_perawatan" type="date" value="${tanggal_perawatan}">
            </div>
        </form>
    `,
        showCancelButton: true,
        confirmButtonText: "Simpan",
        cancelButtonText: "Batal",
        preConfirm: () => {
          const tanggalInput = document.getElementById("tanggal_perawatan").value;

          if (!tanggalInput) {
              Swal.showValidationMessage("Harap isi semua field");
              return false;
          }
  
          const status_perawatan = "Normal";
  
          return { id, tanggal_perawatan: tanggalInput, status_perawatan: status_perawatan };
        },
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: url, 
            method: "POST",
            data: result.value,
            success: function (response) {
              console.log("AJAX response:", response);
              try {
                if (typeof response === "string") {
                  response = JSON.parse(response);
                }
  
                if (response && response.status) {
                  if (response.status === "success") {
                    Swal.fire({
                      title: "Berhasil!",
                      text: response.message,
                      icon: "success"
                    }).then(() => {
                      location.reload();
                    });
                  } else {
                    Swal.fire("Gagal!", response.message, "error");
                  }
                } else {
                  Swal.fire("Gagal!", "Format respons tidak valid.", "error");
                }
              } catch (e) {
                console.error("Error parsing JSON:", e);
                Swal.fire("Gagal!", "Terjadi kesalahan saat mengupdate data.", "error");
              }
            },
            error: function (xhr, status, error) {
              console.error("AJAX error:", status, error);
              Swal.fire("Gagal!", `Terjadi kesalahan saat mengupdate data. Status: ${status}, Error: ${error}`, "error");
            },
          });
        }
      });
    });
  });
}





document.addEventListener('DOMContentLoaded', function() {
  editButton();
  editButtonPerawatan();
});