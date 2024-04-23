    function extractContentForPrinting(){
       
        let header = $(window.document.body).find('h4').html();
        header = header.replace("/", "");

        let currentDate = new Date().toLocaleDateString('en-GB');
        currentDate = currentDate.replace(/\//g, "-");

        var newTable = $(window.document.body).find('table').html();

        var footer = $($("#summarized tfoot").html())
            .find('td[colspan="5"]')    
            .prop('colspan', 4) 
            .end()                             
            .html();                         

        printTableTpl(header, newTable,currentDate, footer);
    }

    function removeColumnByClass() {
        const table = document.getElementById("print_table");
        let columnIndex = -1;
    
        // Find the index of the column to remove
        const headers = table.querySelectorAll('th');
        headers.forEach((header, index) => {
            if (header.classList.contains(className)) {
                columnIndex = index;
            }
        });
    
        // If the column index was found, remove that column from all rows
        if (columnIndex !== -1) {
            const rows = table.querySelectorAll('tr'); // Includes rows in <thead> and <tbody>
            rows.forEach(row => {
                if (row.cells.length > columnIndex) {
                    row.deleteCell(columnIndex);
                }
            });
        }
    }
    

    function printChecked() {
        const heading = document.querySelector('table.table > thead > tr');
        const items = document.querySelectorAll('table.table > tbody > tr');
        let selectedRows = 0;
        
        // Loop through each item in the tbody
        items.forEach((tr) => {
            const input = tr.querySelector('input[type=checkbox]');
            const isChecked = input && input.checked; // Ensure input exists and is checked
    
            if (isChecked) {
                selectedRows++; // Increment the count of selected rows
                tr.classList.remove('no-print'); // Prepare row for printing
            } else {
                tr.classList.add('no-print'); // Hide row from printing
            }
        });
    
        // Manage the heading based on whether there are selected rows
        if (selectedRows > 0) {
            heading.classList.remove('no-print');
        } else {
            heading.classList.add('no-print');
        }
    
        window.print(); // Trigger the print dialogue
    }
    

    function printTableTpl(newH1, newTable,currentDate, footer, column) {

        var newWindow = window.open("", "_blank");
        newWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>

                <title>Nigeria Union of Pensioners</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>
                <link rel="stylesheet" href="http://localhost/css/main.css" />

            </head>
            <body>
                
            </body>
            </html>
        `);
        $(newWindow.document.body).css('background-color', '#fff').prepend(`
            <div class="container-fluid print-view">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="print-header" style="background-color: #009688 !important;">
                            <div class="text-uppercase text-center m">Nigerian Union Of Pensioners</div>
                            <div class="font-18 text-uppercase s text-center">National HeadQuarter</div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h2 class="text-center mt-2" style="font-size:25px font-weight:bold">${newH1}</h2><br>
                        <div class="float-start">Date: ${currentDate}</div>
                        <div class="float-end">Cheque No: ............</div>
                        
                    </div>
                    <div class="col-lg-12 mt-3">
                        <table class="table table-hover table-bordered font-13 nowrap dataTable" id="print_table">
                            ${newTable}
                        </table><br>
                        <div class="row">
                            <div class="col-md-12">
                                <em>We certify that the above statement is correct that the amount involved is in the interest of Nigeria Union of Pensioners and that the amount can be paid</em>
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-md-3">Prepared by:......................</div>
                            <div class="col-md-3">Collected by:.................<br>National Treasurer</div>
                            <div class="col-md-3">........................<br>General Secretary</div>
                            <div class="col-md-3">.........................<br>National President</div>
                        </div>
                    </div>
                </div>
            </div>
        `);

        removeColumnByClass();

    }
        