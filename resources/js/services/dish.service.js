class DishService {
    constructor(baseUrl = "/api/local/dishes", token="") {
        this.api = axios.create({
            baseURL: baseUrl,
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                'Authorization': `bearer ${token}`
            }
        });
    }

    async getAllByName(name) {
        return (await this.api.get(`/?name=${name}`)).data;
    }

    async getAllByCategoryId(categoryId) {
        return (await this.api.get(`/?categoryId=${categoryId}`)).data;
    }

    async get(id) {
        return (await this.api.get(`/${id}`)).data;
    }
}

export default new DishService();