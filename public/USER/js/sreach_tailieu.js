document.addEventListener("DOMContentLoaded", function() {
    const fileTypeSelect = document.getElementById("fileType");
    const languageSelect = document.getElementById("language");
    const clearAllBtn = document.getElementById("clearAllBtn");

    fileTypeSelect.addEventListener("change", filterDocuments);
    languageSelect.addEventListener("change", filterDocuments);
    clearAllBtn.addEventListener("click", clearFilters);

    function filterDocuments() {
        const fileType = fileTypeSelect.value;
        const language = languageSelect.value;
        const documents = document.querySelectorAll(".document");

        documents.forEach(doc => {
            const matchesFileType = fileType === "all" || doc.getAttribute("data-type") === fileType;
            const matchesLanguage = language === "all" || doc.getAttribute("data-language") === language;

            if (matchesFileType && matchesLanguage) {
                doc.style.display = "";
            } else {
                doc.style.display = "none";
            }
        });
    }

    function clearFilters() {
        fileTypeSelect.value = "all";
        languageSelect.value = "all";
        filterDocuments();
    }
});

