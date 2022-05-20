import React, { useEffect } from 'react';
import { Form, Input, Row, Col, Button, Select, InputNumber } from 'antd';
const { Option } = Select
import axios from "axios";

function EditUser() {
    const [form] = Form.useForm();

    const onFinish = (values) => {
        console.log(values);
        axios.post('/api/edit-user', values)
            .then(res => {
                console.log(res);
                form.resetFields()
                alert('Thêm thành công')
            })
            .catch(err => console.log(err))
    };

    const onFinishFailed = (errorInfo) => {
        console.log('Failed:', errorInfo);
        alert('Kiểm tra lại các Trường!!')
    };

    useEffect(() => {
        let url = window.location.href
        let params = url.split('/')
        let param = params[5]
        axios.get(`/api/get-user/${param}`)
            .then((response) => {
                let data = response.data;
                form.setFieldsValue({
                    'id': data.id,
                    'user_name': data.user_name,
                    'email':data.email,
                    'group_id':`${data.group_id}`,
                })
            })
            .catch()

    }, [])


    return (
        <Row>
            <Col offset={4} span={8}>
                <h1 style={{ fontSize: 25, fontWeight: 700, marginLeft: 33 }}>Edit User</h1>
                <Form
                    name="basic"
                    labelCol={{
                        span: 8,
                    }}
                    wrapperCol={{
                        span: 16,
                    }}
                    form={form}
                    initialValues={{
                        remember: true,
                    }}
                    onFinish={onFinish}
                    onFinishFailed={onFinishFailed}
                    autoComplete="off"
                >
                    <Form.Item
                        label="Id User"
                        name="id"
                        rules={[
                            
                        ]}
                    >
                        <InputNumber disabled/>
                    </Form.Item>

                    <Form.Item
                        label="User Name"
                        name="user_name"
                        rules={[]}>
                        <Input />
                    </Form.Item>

                    <Form.Item
                        label="Email"
                        name="email"
                        rules={[
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
                        
                    >
                        <Input.Password placeholder='Nhập mật khẩu mới!!' />
                    </Form.Item>

                    <Form.Item
                        label="Member Group"
                        name='group_id'
                    >
                        <Select>
                            <Option key={1} values='1'>Admin</Option>
                            <Option key={2} values='2'>Dev</Option>
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

export default EditUser;