import { useState, useContext, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { AuthContext } from "../../auth/AuthContext";

export default function Login() {
    const { login, user } = useContext(AuthContext);
    const navigate = useNavigate();

    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        if (user) {
            navigate("/", { replace: true });
        }
    }, [user]);


    const handleSubmit = async (e) => {
        e.preventDefault();

        setError(null);
        setLoading(true);

        try {
            await login(email, password);
            navigate("/", { replace: true });
        } catch (err) {
            setError("Credenciales incorrectas");
        } finally {
            setLoading(false);
        }
    };

    return (
        <div style={{ maxWidth: 400, margin: "100px auto" }}>
        <h1>Login</h1>

        <form onSubmit={handleSubmit}>
            <div>
            <label>Email</label>
            <input
                type="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                required
            />
            </div>

            <div style={{ marginTop: 10 }}>
            <label>Password</label>
            <input
                type="password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
            />
            </div>

            {error && (
            <div style={{ color: "red", marginTop: 10 }}>
                {error}
            </div>
            )}

            <button
            type="submit"
            disabled={loading}
            style={{ marginTop: 20 }}
            >
            {loading ? "Logging in..." : "Login"}
            </button>
        </form>
        </div>
    );
}
