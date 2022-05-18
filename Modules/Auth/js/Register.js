import { useHistory } from 'react-router-dom'
import {
    Form,
    Input,
    Button,
    Col,
    Row,
} from "antd";
import axios from 'axios';

const layout = {
    labelCol: {
        span: 8,
    },
    wrapperCol: {
        span: 16,
    },
};

const validateMessages = {
    required: "${label} is required!",
    types: {
        email: "${label} is not a valid email!",
        number: "${label} is not a valid number!",
    },
    number: {
        range: "${label} must be between ${min} and ${max}",
    },
};

const Register = () => {
    const history = useHistory();

    const onFinish = (values) => {
        axios.post('/api/register', values)
            .then(res => {
                console.log(res);
                alert('Đăng kí thành công')
            })
            .catch(err => {
                console.log(err.message)
                alert('Đăng kí thất bại')

            })
    };

    const gotoLogin = () => {
        history.push('/auth/login')
    }

    return (
        <div className="register-form">

            <Row gutter={4}>
                <Col offset={6} className="gutter-row" span={12}>
                    <div className="form__register">
                        <h1 className="register-title"> Đăng kí tài khoản Ureka</h1>
                        <Form
                            {...layout}
                            name="nest-messages"
                            onFinish={onFinish}
                            validateMessages={validateMessages}
                        >
                            <Form.Item
                                label="User Name"
                                name="user_name"
                                rules={[{
                                    required: true
                                }, 
                                {
                                    min:5,
                                    message:'User name min 5 charater!'
                                }
                                ]}
                            >
                                <Input />
                            </Form.Item>

                            <Form.Item
                                label="Email"
                                name="email"
                                rules={[
                                    {
                                        type: "email",
                                        message: "Email Address Format Invalid!!",
                                    },
                                    {
                                        required: true,
                                        message: "Please input Email Address",
                                    },
                                ]}
                            >
                                <Input />
                            </Form.Item>

                            <Form.Item
                                label="Password"
                                name="password"
                                rules={[
                                    {
                                        required: true,
                                        message: "Please enter password!!",
                                    },
                                    {
                                        min:6,
                                        message:'Password min 6 charater!'
                                    }
                                ]}
                            >
                                <Input.Password />
                            </Form.Item>

                            <Form.Item wrapperCol={{ ...layout.wrapperCol, offset: 8 }}>
                                <Button type="primary" htmlType="submit">
                                    Submit
                                </Button>

                                <Button type="link" htmlType="button" onClick={gotoLogin}>
                                    Đã có tài khoản? Login ngay
                                </Button>
                            </Form.Item>
                        </Form>
                    </div>

                </Col>
            </Row>
        </div>
    );
};

export default Register;
