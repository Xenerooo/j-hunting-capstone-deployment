function fileUploading() {
    $("#dropzone-file").on("change", function (e) {
        e.preventDefault();

        if ($("#file-storage .file-container").length > 0) {
            alert("Please remove the existing item before adding a new one.");
            return;
        }

        let fileName = e.target.files[0].name;

        let template = `
      <div class="file-container w-full flex justify-between items-center ">
          <div class="flex w-fit items-center text-gray-100">
              <span class="mr-2 bg-gray-800 px-2 rounded-md">
                  PDF
              </span>
              <h3 class="w-[300px] break-words whitespace-normal">${fileName}</h3>
          </div>
          <div>
              <span class="remove-file cursor-pointer shadow rounded-full text-gray-200 flex justify-end p-1 hover:bg-red-400 duration-200">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                      <path d="M18 6 6 18" />
                      <path d="m6 6 12 12" />
                  </svg>
              </span>
          </div>
      </div>
`;

        $("#file-storage").append(template);
    });

    $(document).on("click", ".remove-file", function () {
        $(this).closest(".file-container").remove();
    });
}

// for create profile
function selectProfile() {
    $("#edit-image").on("click", function () {
        $("#select-profile").click();
    });

    $("#select-profile").on("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $("#edit-image").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
}

//job post image upload
function imageUpload() {
    $(function () {
        $("#select-image").on("click", function () {
            $("#image-input").click();
        });

        $("#image-input").on("change", function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $("#image-preview").attr("src", e.target.result);
                    $("#preview-container").removeClass("hidden");
                };
                reader.readAsDataURL(file);
            }
        });

        $("#remove-image-button").on("click", function () {
            $("#image-input").val("");
            $("#preview-container").addClass("hidden");
            $("#image-preview").attr("src", "");
        });
    });
}

$(function () {
    fileUploading();
    selectProfile();
    imageUpload();
});
