document.addEventListener("DOMContentLoaded", function () {
  // Inisialisasi dropdown
  const selectedOption = document.getElementById("selectedOption<?= $urut ?>");
  const dropdownOptions = document.getElementById(
    "dropdownOptions<?= $urut ?>"
  );
  const inputBobot = document.getElementById("inputBobot<?= $urut ?>");

  // Toggle dropdown ketika dipilih
  selectedOption.addEventListener("click", function () {
    dropdownOptions.style.display =
      dropdownOptions.style.display === "block" ? "none" : "block";
  });

  // Pilih opsi dari dropdown
  const options = dropdownOptions.getElementsByClassName("dropdown-option");
  for (let option of options) {
    option.addEventListener("click", function () {
      selectedOption.textContent = option.textContent; // Update teks yang dipilih
      inputBobot.value = option.getAttribute("data-value"); // Update nilai yang terpilih
      dropdownOptions.style.display = "none"; // Menutup dropdown
      if (option.getAttribute("data-value") == "<?= $nilai ?>") {
        selectedOption.classList.add("highlighted");
      } else {
        selectedOption.classList.remove("highlighted");
      }
    });
  }

  // Menutup dropdown jika klik di luar
  document.addEventListener("click", function (event) {
    if (!event.target.closest(".custom-dropdown")) {
      dropdownOptions.style.display = "none";
    }
  });
});
