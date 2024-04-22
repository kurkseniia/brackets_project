var app = new Vue({
    el: "#app",
    data: {
        expressions: [],
        inputValue: "",
        result: null,
        errorMessage: "",
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                const response = await axios.get("get_expressions_history.php");
                if (response && response.data) {
                    this.expressions = response.data;
                } else {
                    this.errorMessage = "Пустой ответ сервера или отсутствует data в ответе";
                }
            } catch (error) {
                this.handleError(error);
            }
        },
        async sendData() {
            if (!this.inputValue.trim()) {
                this.errorMessage = "Пожалуйста, введите выражение";
                this.result = null; // clear result if input is empty
                return;
            }
            try {
                const response = await axios.post("brackets_function.php", {
                    data: this.inputValue,
                });
                if (response && response.data) {    
                    this.result = response.data;
                    this.errorMessage = ""; // clear error message if everything was successful
                    this.fetchData();
                } else {
                    this.errorMessage = "Пустой ответ сервера или отсутствует data в ответе";
                }
            } catch (error) {
                this.handleError(error);
            }
        },

        async deleteExpression(expressionID) {
        try {
            const response = await axios.post("delete_expression.php", {
                expressionID: expressionID,
            });
            if (response && response.data) {
                // Updat data after deleting the row
                this.fetchData();
            } else {
                this.errorMessage = "Пустой ответ сервера";
            }
        } catch (error) {
            this.handleError(error);
        }
    },
        handleError(error) {
            this.errorMessage = "Ошибка: " + error.message;
        },
    },
});
