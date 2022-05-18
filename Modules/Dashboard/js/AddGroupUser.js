import React from 'react';
import { Form, Input, Button, Row, Col, InputNumber } from 'antd'

import axios from 'axios'

function AddGroupUser(props) {
    const onFinish = (values) => {
        axios.post('/api/add-group', values)
            .then(function (response) {
                console.log(response.data);
                alert('Thêm nhóm thành công')
            })
            .catch(function (error) {
                if (error) {
                    console.log(error);
                    alert('Thêm nhóm không thành công')
                }
            });
    };

    const onFinishFailed = (errorInfo) => {
        console.log('Failed:', errorInfo);
    };

    return (
        <Row>
            <Col offset={8} span={8}>
                <h1 style={{ fontSize: 25, fontWeight: 700, marginLeft: 33 }}>Add Group user</h1>
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
                        label="Group Id"
                        name="group_id"
                        rules={[
                            {
                                required: true,
                                message: 'Please input your Group Id!',
                            },
                            {
                                type: 'number',
                                min: 0,
                                message: 'Group ID valid is greate than 0!!!',

                            }
                        ]}
                    >
                        <InputNumber />
                    </Form.Item>

                    <Form.Item
                        label="Group Name"
                        name="group_name"
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

export default AddGroupUser;