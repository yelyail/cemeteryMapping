function searchPlot() {
    if (event.key === "Enter") {
        const input = document.getElementById("searchInput").value.trim().toLowerCase();
        const ownerNames = document.querySelectorAll('.TableContent tbody tr td:nth-child(2)');
        let plotFound = false;

        ownerNames.forEach(cemetery => {
            const ownerName = cemetery.textContent.trim().toLowerCase();
            const row = cemetery.parentElement; 

            if (ownerName.includes(input)) {
                row.style.display = ''; 
                plotFound = true;
            } else {
                row.style.display = 'none'; 
            }
        });

        if (!plotFound) {
            Swal.fire({
                icon: "error",
                title: "Record not found!",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            });
        }
    }
}
function searchPlotPurchase() {
    if (event.key === "Enter") {
        const input = document.getElementById("searchInput").value.trim().toLowerCase();
        const ownerNames = document.querySelectorAll('.TableContent tbody tr td:nth-child(3)');
        let plotFound = false;
        ownerNames.forEach(cemetery => {
            const ownerName = cemetery.textContent.trim().toLowerCase();
            const row = cemetery.parentElement; 
            if (ownerName.includes(input)) {
                row.style.display = ''; 
                plotFound = true;
            } else {
                row.style.display = 'none'; 
            }
            });
            if (!plotFound) {
                Swal.fire({
                icon: "error",
                title: "Buyer not found!",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            });
        }
    }
}
function searchPlotHistorical() {
    if (event.key === "Enter") {
        const input = document.getElementById("searchInput").value.trim().toLowerCase();
        const ownerNames = document.querySelectorAll('.TableContent tbody tr td:nth-child(5)');
        let plotFound = false;
        ownerNames.forEach(cemetery => {
            const ownerName = cemetery.textContent.trim().toLowerCase();
            const row = cemetery.parentElement; 
            if (ownerName.includes(input)) {
                row.style.display = ''; 
                plotFound = true;
            } else {
                row.style.display = 'none'; 
            }
        });
        if (!plotFound) {
            Swal.fire({
                icon: "error",
                title: "Decease not found!",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            });
        }
    }
} 
function searchPlotDashboard() {
    if (event.key === "Enter") {
        const input = document.getElementById("searchInput").value.trim().toLowerCase();
        const plots = document.querySelectorAll('.plot');
        let plotFound = false;
        plots.forEach(plot => {
            const plotNumber = plot.textContent.trim().toLowerCase();
            if (plotNumber === input) {
                plot.classList.add('searched');
                plot.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
                plotFound = true;
            } else {
                plot.classList.remove('searched');
            }
        });
        const cemeteryNames = document.querySelectorAll('.emptyRow td');
        cemeteryNames.forEach(cemetery => {
            const cemeteryName = cemetery.textContent.trim().toLowerCase();
            if (cemeteryName === input) {
                cemetery.style.fontWeight = 'bold';
                cemetery.style.color = '#494848';
                cemetery.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
                plotFound = true;
            } else {
                cemetery.parentNode.style.background = ''; 
            }
        });
        if (!plotFound) {
            Swal.fire({
                icon: "error",
                title: "Plot or Ccemetery Not Found!",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            });
        }
    }
}