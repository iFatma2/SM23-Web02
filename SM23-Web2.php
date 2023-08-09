

<!DOCTYPE html>
<html>
    <head>
        <title>Control Movement</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
  canvas {
    border: 2px solid black;
    position: absolute;
    left: 800px;
    top: 100px;
  }
</style>
        <style>
            
            .container{overflow: hidden;}
            .tab{float: left;}
            .tab-1{margin-top: 300px;}
            .tab-1{margin-left: 200px;}
            .tab-2{margin-right: 30px;}
            .tab-2 input{display: block;margin-bottom: 10px;}
            tr{transition:all .25s ease-in-out}
            tr:hover{background-color:#EEE;cursor: pointer;}
            
        </style>
        
        
    </head>
    <body bgcolor="#dabae7">
        <form action="save.php" method="post">
        
        <div class="container">
            <div class="tab tab-1">
                <table id="table" border="1">
                    <tr>
                        <th>Right</th>
                        <th>Left</th>
                        <th>Forward</th>
                        <th>Backward</th>
                    </tr>
                    <tr>
                        <td>Null</td>
                        <td>Null</td>
                        <td>Null</td>
                        <td>Null</td>
                    </tr>
                    
                    
                </table>
            </div>
            <div class="tab tab-2">
                Right :<input type="number" name="Right" id="Right"  oninput="drawArrows()">
                Left :<input type="number" name="Left" id="Left"  oninput="drawArrows()">
                Forward :<input type="number" name="Forward" id="Forward"  oninput="drawArrows()">
                Backward :<input type="number" name="Backward" id="Backward"  oninput="drawArrows()">
                
                <button name="Save" onclick="saveHtmlTableRow();">Save</button>

                <button onclick="deleteSelectedRow();">Delete</button>
            </div>
        </div>

        <canvas id="arrowCanvas" width="500" height="500"></canvas>

<script>
const canvas = document.getElementById('arrowCanvas');
const ctx = canvas.getContext('2d');

let arrows = [];

function drawArrows() {
  arrows = [];

  const rightLength = parseInt(document.getElementById('Right').value);
  const leftLength = parseInt(document.getElementById('Left').value);
  const forwardLength = parseInt(document.getElementById('Forward').value);
  const backwardLength = parseInt(document.getElementById('Backward').value);

  if (rightLength > 0) arrows.push({ x: rightLength, y: 0 });
  if (leftLength > 0) arrows.push({ x: -leftLength, y: 0 });
  if (forwardLength > 0) arrows.push({ x: 0, y: -forwardLength });
  if (backwardLength > 0) arrows.push({ x: 0, y: backwardLength });

  ctx.clearRect(0, 0, canvas.width, canvas.height);

  let currentX = canvas.width / 2;
  let currentY = canvas.height / 2;

  for (const arrow of arrows) {
    const endX = currentX + arrow.x;
    const endY = currentY + arrow.y;

    ctx.beginPath();
    ctx.moveTo(currentX, currentY);
    ctx.lineTo(endX, endY);
    ctx.strokeStyle = '#0000FF'; 
    ctx.lineWidth = 2; 
    ctx.stroke();

    drawArrowhead(endX, endY, arrow.x, arrow.y);

    currentX = endX;
    currentY = endY;
  }
}

function drawArrowhead(x, y, dx, dy) {
  const headSize = 10;

  const angle = Math.atan2(dy, dx);
  const headX = x - headSize * Math.cos(angle);
  const headY = y - headSize * Math.sin(angle);

  ctx.beginPath();
  ctx.moveTo(x, y);
  ctx.lineTo(headX - headSize * Math.cos(angle - Math.PI / 6), headY - headSize * Math.sin(angle - Math.PI / 6));
  ctx.lineTo(headX - headSize * Math.cos(angle + Math.PI / 6), headY - headSize * Math.sin(angle + Math.PI / 6));
  ctx.closePath();
  ctx.fillStyle = '#FF0000';
  ctx.fill();
}


</script>
        <script>
            
            var rIndex,
                table = document.getElementById("table");
            
            // check the empty input
            function checkEmptyInput()
            {
                var isEmpty = false,
                    Right = document.getElementById("Right").value,
                    Left = document.getElementById("Left").value,
                    Forward = document.getElementById("Forward").value
                    Backward = document.getElementById("Backward").value;;
            
                if(Right === ""){
                    alert("First Field Connot Be Empty");
                    isEmpty = true;
                }
                else if(Left === ""){
                    alert("Second Field Connot Be Empty");
                    isEmpty = true;
                }
                else if(Forward === ""){
                    alert("Third Field Connot Be Empty");
                    isEmpty = true;
                }
                else if(Backward === ""){
                    alert("Fourth Field Connot Be Empty");
                    isEmpty = true;
                }
                return isEmpty;
            }
            
            // add Row
            function saveHtmlTableRow()
            {
                // get the table by id
                // create a new row and cells
                // get value from input text
                // set the values into row cell's

                if(!checkEmptyInput()){
                var newRow = table.insertRow(table.length),
                    cell1 = newRow.insertCell(0),
                    cell2 = newRow.insertCell(1),
                    cell3 = newRow.insertCell(2),
                    cell4 = newRow.insertCell(3),

                    Right = document.getElementById("Right").value,
                    Left = document.getElementById("Left").value,
                    Forward = document.getElementById("Forward").value,
                    Backward = document.getElementById("Backward").value;
            
                cell1.innerHTML = Right;
                cell2.innerHTML = Left;
                cell3.innerHTML = Forward;
                cell4.innerHTML = Backward;
                // call the function to set the event to the new row
                selectedRowToInput();
                
            }
            }
            
            // display selected row data into input text
            function selectedRowToInput()
            {
                
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                      // get the seected row index
                      rIndex = this.rowIndex;
                      document.getElementById("Right").value = this.cells[0].innerHTML;
                      document.getElementById("Left").value = this.cells[1].innerHTML;
                      document.getElementById("Forward").value = this.cells[2].innerHTML;
                      document.getElementById("Backward").value = this.cells[3].innerHTML;
                    };
                }
            }
            selectedRowToInput();
            
            function deleteSelectedRow()
            {
                table.deleteRow(rIndex);
                // clear input text
                document.getElementById("Right").value = "";
                document.getElementById("Left").value = "";
                document.getElementById("Forward").value = "";
                document.getElementById("Backward").value = "";
                selectedRowToInput();
            }
            selectedRowToInput();
        </script>
        </form>
        
    </body>
</html>


<script>