import React, { useState } from 'react';
import axios from '../axiosConfig';

const Applicants = () => {
    const [applicants, setApplicants] = useState([]);
    const [county, setCounty] = useState('');
    const [requireDBSCheck, setRequireDBSCheck] = useState('');
    const [appliedFor, setAppliedFor] = useState('');

    const fetchApplicants = async () => {
        try {
            const response = await axios.get('/applicants', {
                params: {
                    county,
                    require_dbs_check: requireDBSCheck,
                    applied_for: appliedFor,
                },
                withCredentials: true,
                headers: {
                    'Content-Type': 'application/json',
                },
            });
            setApplicants(response.data);
        } catch (error) {
            console.error('Error fetching applicants', error);
        }
    };

    return (
        <div>
            <h1>Applicants</h1>
            <input
                value={county}
                onChange={(e) => setCounty(e.target.value)}
                placeholder="County"
            />
            <input
                value={requireDBSCheck}
                onChange={(e) => setRequireDBSCheck(e.target.value)}
                placeholder="Require DBS Check"
            />
            <input
                value={appliedFor}
                onChange={(e) => setAppliedFor(e.target.value)}
                placeholder="Position Applied For"
            />
            <button onClick={fetchApplicants}>Search</button>
            <ul>
                {applicants.map(applicant => (
                    <li key={applicant.id}>
                        {applicant.name} - {applicant.email}
                        <a href={`http://localhost:8000/api/applicants/download-cv/${applicant.id}`}>Download CV</a>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default Applicants;