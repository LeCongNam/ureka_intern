import React, { useState } from 'react';
import { Form, Input, Button, Row, Col, Upload } from 'antd';
import { Tabs } from 'antd';
import { UploadOutlined } from '@ant-design/icons';
import DevForm from "./DevForm";
import ProductForm from "./ProductForm";
const { TabPane } = Tabs;
// const axios = require('axios').default
import axios from 'axios';

const layout = {
    labelCol: {
        span: 8,
    },
    wrapperCol: {
        span: 16,
    },
};
/* eslint-disable no-template-curly-in-string */

const validateMessages = {
    required: '${label} is required!',
    types: {
        email: '${label} is not a valid email!',
        number: '${label} is not a valid number!',
    },
    number: {
        range: '${label} must be between ${min} and ${max}',
    },
};
/* eslint-enable no-template-curly-in-string */

(() => {
    document.title = "Add Product";
})()

function AddProduct(props) {
    var file
    const [form] = Form.useForm();
    const [type, setType] = useState('dev');

    const normFile = (e) => {
        file = { ...e.file }
        return e && e.fileList;
    };

    const onFinish = (formValues) => {
        delete formValues?.upload
        formValues['type'] = type
        console.log(formValues);
        let { originFileObj, ...args } = file
        formValues['icon'] = file.originFileObj || {}
        let formData = new FormData();
        for (const key in formValues) {
            formData.append(key, formValues[key]);
        }
        axios.post('/api/add-product', formData)
            .then((res) => {
                console.log(res)
                form.resetFields();
                alert('Thành công')
            })
            .catch(err => {
                console.log(err)
                alert('Trùng Sản phẩm')
            })
            .then((res) => console.log(res))


    };

    const tabInfo = (activeKey) => {
        setType(activeKey)
    }

    return (
        <div>
            <Row>
                <Col offset={4} span={9}>
                    <Form {...layout} name="nest-messages"  form={form} onFinish={onFinish} validateMessages={validateMessages}>
                        <Form.Item
                            name="product_id"
                            label="Product ID"
                            rules={[
                                {
                                    required: true,
                                    message: "Please enter product name"
                                },
                            ]}
                        >
                            <Input />
                        </Form.Item>

                        <Form.Item
                            name="product_name"
                            label="Product Name"
                            rules={[
                                {
                                    required: true,
                                    message: "Please enter product name"
                                },
                            ]}
                        >
                            <Input />
                        </Form.Item>

                        <Form.Item name="desc" label="Product Desc"
                            rules={
                                [
                                    {
                                        required: true,
                                        message: 'Please enter Description Product'
                                    }
                                ]
                            }
                        >
                            <Input.TextArea />
                        </Form.Item>

                        <Tabs defaultActiveKey="dev" centered onChange={tabInfo}>
                            <TabPane tab="dev" key="dev">
                                <DevForm/>
                            </TabPane>
                            <TabPane tab="product" key="prod">
                                <ProductForm/>
                            </TabPane>
                        </Tabs>
                        <Form.Item
                            name="upload"
                            label="Upload"
                            valuePropName="fileList"
                            getValueFromEvent={normFile}
                            extra="upload Imgae"
                        >
                            <Upload name="logo" listType="picture">
                                <Button icon={<UploadOutlined />}>Click to upload</Button>
                            </Upload>
                        </Form.Item>
                        <Form.Item wrapperCol={{ ...layout.wrapperCol, offset: 8 }}>
                            <Button type="primary" htmlType="submit">
                                Submit
                            </Button>
                        </Form.Item>
                    </Form>
                </Col>
            </Row>
        </div>
    );
}

export default AddProduct;
