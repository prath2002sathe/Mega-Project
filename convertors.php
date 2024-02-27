<iframe id="txtArea1" style="display:none"></iframe>
<button class="btn btn-danger btn-fill" style="margin-left:18px;"onclick="printDiv()">PDF</button>
<button class="btn btn-danger btn-fill" onclick="ExportToExcel()">EXCEL</button>
<br><br>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>
    function printDiv(){
        $('body > :not(table)').hide(); //hide all nodes directly under the body
        $('#print').appendTo('body');
        print();
        window.location.reload();
    }

        function ExportToExcel(type, fn, dl) {
        var links = document.getElementsByTagName('a');
        var link;
        for (var i = 0 ; i < links.length; i++)
        {
        link = links[i].href;
        console.log(link);
        links[i].innerHTML= link;
        }
        
        var elt = document.getElementById('print');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        window.location.reload();
         return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx'))); 
         
        }

</script>

