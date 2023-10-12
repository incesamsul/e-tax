var selectedOptions = [];

function updateSelected() {
    var selectElement = document.getElementById('cabang');
    var selectedOption = selectElement.options[selectElement.selectedIndex];

    if (selectedOption.value !== '') {
        if (!selectedOptions.includes(selectedOption.value)) {
            selectedOptions.push(selectedOption.value);
            displaySelected();
            updateSelectedInput();
        }
    }
}

function displaySelected() {
    var selectedDisplay = document.getElementById('selectedDisplay');
    selectedDisplay.innerHTML = "Selected Options: <br><br>" + selectedOptions.map((value, index) => {
        let name = value.split('-')[1];
        return name + ' <button class="btn btn-danger" onclick="removeSelected(' + index + ')"><i class="fas fa-times"></i></button><br><br>';
    }).join(', ');
}

function removeSelected(index) {
    selectedOptions.splice(index, 1);
    displaySelected();
    updateSelectedInput();
}

function updateSelectedInput() {
    var selectedOptionsInput = document.getElementById('selectedOptions');
    selectedOptionsInput.value = selectedOptions.join(',');
}