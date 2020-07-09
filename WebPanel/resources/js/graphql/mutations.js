import gql from "graphql-tag"

export const LOGIN_USER = gql`
    mutation($input: LoginInput!) {
        login(input: $input){
            access_token
            refresh_token
            expires_in
            token_type
            user {
                id
                email
                username
            }
        }
    }`;

export const WRITE_AUTH = gql`
    mutation ($input: AuthenticatedInput!){
        writeAuth(input: $input) @client
    }

`;

export const LOGOUT_USER = gql`
    mutation {
        logout {
            status
            message
        }
    }
`;