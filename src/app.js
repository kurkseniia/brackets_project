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
                this.result = null; // Очищаем результат, если поле ввода пустое
                return;
            }
            try {
                const response = await axios.post("brackets_function.php", {
                    data: this.inputValue,
                });
                if (response && response.data) {    
                    this.result = response.data;
                    this.errorMessage = ""; // Очищаем сообщение об ошибке, если все прошло успешно
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
                // Обновляем данные после удаления строки
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
