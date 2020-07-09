import gql from "graphql-tag";

export const USERS = gql`
    query {
        users {
            data {
                id
                username
                roles {
                    id
                }
            }
            paginatorInfo {
                currentPage
                count
            }
        }
    }
`;

export const ROLE_NAMES = gql`
    query {
        roles{
            id
            name
        }
    }
`;

export const LOGGED_IN_USER = gql`
    query {
        me {
            id
            username
            email
        }
    }
`;

export const AUTH_CHECK = gql`
    {
        authenticated @client {
            isAuthenticated
        }
    }
`;

export const GET_AUTHENTICATED = gql`
    {
        authenticated @client {
            userId
            accessToken
            isAuthenticated
        }
    }
`;
