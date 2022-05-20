import { useHistory } from 'react-router-dom';
import {  Form, Input, Checkbox, Button } from 'antd';
const axios = require('axios').default;

function Login() {
    const history = useHistory();

    const onFinish = values => {
        axios.post('/api/login', values)
          .then(function (response) {
            let res = response?.data
            // localStorage.setItem('group_id',res.group_id)

            let group = res.group_id
            if (group == 1) {
                history.push('/admin')
                window.location.reload();
            }else{
                history.push('/category')
                window.location.reload();
            }
          })
          .catch(function (error) {
              alert('Email or Password Invalid!!!')
             console.log(error?.message?.data);
          });
    };

    const onFinishFailed = errorInfo => {
        console.log('Failed:', errorInfo);
        alert('Please Enter all Field!!!')
    };

    const gotoRegister = ()=>{
        history.push('/auth/register')
    }

    return (
        <div className="login-page">
            <div className="login-box">
                <div className="illustration-wrapper">
                    <img src="https://mixkit.imgix.net/art/preview/mixkit-left-handed-man-sitting-at-a-table-writing-in-a-notebook-27-original-large.png?q=80&auto=format%2Ccompress&h=700" alt="Login" />
                </div>
                <Form
                    name="login-form"
                    initialValues={{ remember: true }}
                    onFinish={onFinish}
                    onFinishFailed={onFinishFailed}
                >
                    <p className="form-title">Welcome back</p>
                    <p>Login to Ureka Media</p>
                    <Form.Item
                        name="user_name"
                        rules={[{
                            required: true,
                            message: 'Please input your username!',
                        },
                        {
                            min: 5,
                            message: 'User Name min 5 charater',
                        }
                        ]}
                    >
                        <Input
                            placeholder="Username"
                        />
                    </Form.Item>

                    <Form.Item
                        name="password"
                        rules={[
                            { required: true, message: 'Please input your password!' },
                            { min: 6, message: 'Password min 6 charater' }
                        ]}
                    >
                        <Input.Password
                            placeholder="Password"
                        />
                    </Form.Item>

                    <Form.Item name="remember" valuePropName="checked">
                        <Checkbox>Remember me</Checkbox>
                    </Form.Item>

                    <Form.Item>
                        <Button type="primary" htmlType="submit" className="login-form-button">
                            LOGIN
                        </Button>
                    </Form.Item>

                    <Form.Item>
                        <Button type="link" htmlType="button" onClick={gotoRegister}>
                            Đăng kí tài khoản
                        </Button>
                    </Form.Item>

                </Form>
            </div>
        </div>
    );
}


export default Login;
