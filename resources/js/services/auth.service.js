class AuthService {
    constructor(baseUrl = "/api/local/user", token = "") {
        this.api = axios.create({
            baseURL: baseUrl,
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                'Authorization': `bearer ${token}`
            }
        })
    }

    async user() {
        return (await this.api.get('/')).data;
    }
}

export default new AuthService("/api/local/user",localStorage.getItem("token"));