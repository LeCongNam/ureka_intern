import React from 'react';
import { Form, Input, Row, Col, Button, Select } from 'antd';
const { Option } = Select
import axios from "axios";

function AddUser(props) {
    const [form] = Form.useForm();

    const onFinish = (values) => {
        console.log(values);
        axios.post('/api/add-user',values)
        .then(res=>{
            console.log(res);
            form.resetFields()
            alert('Thêm thành công')
        })
        .catch(err=>console.log(err))
    };

    const onFinishFailed = (errorInfo) => {
        console.log('Failed:', errorInfo);
    };

    return (
        <Row>
            <Col offset={4} span={8}>
                <h1 style={{ fontSize: 25, fontWeight: 700, marginLeft: 33 }}>Add User</h1>
                <Form
                    name="basic"
                    labelCol={{
                        span: 8,
                    }}
                    wrapperCol={{
                        span: 16,
                    }}
                    initialValues={{
                        remember: true,
                    }}
                    onFinish={onFinish}
                    onFinishFailed={onFinishFailed}
                    autoComplete="off"
                >
                    <Form.Item
                        label="User Name"
                        name="user_name"
                        rules={[
                            {
                                required: true,
                                message: 'Please input your username!',
                            },
                        ]}
                    >
                        <Input />
                    </Form.Item>

                    <Form.Item
                        label="Email"
                        name="email"
                        rules={[
                            {
                                required: true,
                                message: 'Please input your username!',
                            },
                            {
                                type: 'email',
                                message: 'Please input email valid',
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
                                message: 'Please input your password!',
                            },
                        ]}
                    >
                        <Input.Password />
                    </Form.Item>

                    <Form.Item
                        label="Member Group"
                        name='group_id'
                    >
                        <Select>
                            <Option key={1} values='1'>dev</Option>
                            <Option key={2} values='2'>Admin</Option>
                        </Select>
                    </Form.Item>

                    <Form.Item
                        wrapperCol={{
                            offset: 8,
                            span: 16,
                        }}
                    >
                        <Button type="primary" htmlType="submit">
                            Submit
                        </Button>
                    </Form.Item>
                </Form>
            </Col>
        </Row>
    );
}

export default AddUser;