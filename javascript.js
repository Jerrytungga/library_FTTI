function searchTable() {
    var input, filter, table, tr, td, i, j, txtValue, shouldShow;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
        tr[i].style.display = "none"; // Hide the row initially
        td = tr[i].getElementsByTagName("td");
        shouldShow = false;
        
        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    shouldShow = true;
                    break; // Exit inner loop if a match is found
                }
            }
        }
        
        if (shouldShow) {
            tr[i].style.display = "";
        }
    }
}
