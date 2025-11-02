    function fetchSupplierDetails(supplierId) {
        if (!supplierId) {
            // Clear fields if no supplier is selected
            document.getElementById("supply_product").value = "";
            document.getElementById("received_date").value = "";
            document.getElementById("manufacture_date").value = "";
            document.getElementById("expire_date").value = "";
            return;
        }

        // Send an AJAX request to fetch supplier details
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "fetch_supplier_details.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                // Populate fields with fetched data
                document.getElementById("supply_product").value = response.supply_product || "";
                document.getElementById("received_date").value = response.received_date || "";
                document.getElementById("manufacture_date").value = response.manufacture_date || "";
                document.getElementById("expire_date").value = response.expire_date || "";
            }
        };
        xhr.send("supplier_id=" + supplierId);
    }
