function validateNumberInput(elementIds, allowSymbol = false) {
    // If elementIds is not an array, make it an array
    if (!Array.isArray(elementIds)) {
        elementIds = [elementIds];
    }

    elementIds.forEach(function(elementId) {
        console.log('validateNumberInput is called with elementId: ' + elementId);
        const element = document.getElementById(elementId);
        if (element) {
            element.addEventListener('input', function () {
                if (allowSymbol) {
                    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                    if (this.value.startsWith('.')) {
                        this.value = '0' + this.value;
                    }
                } else {
                    this.value = this.value.replace(/[^0-9]/g, '');
                }
            });
        }
    });
}
