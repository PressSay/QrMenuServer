class CustomerService {
    constructor(baseUrl = "/api/local/customers", token = "") {
        this.api = axios.create({
            baseURL: baseUrl,
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                'Authorization': `bearer ${token}`
            }
        })
    }

    async getAll() {
        return (await this.api.get(`/`)).data;
    }

    async create(data) {
        return (await this.api.post('/', data)).data;
    }
}

export default new CustomerService();